<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;


class CartApiController extends Controller
{
// Hardcoded user id as per specification
protected $userId = 1;


public function list()
{
$items = CartItem::with('product')->where('user_id', $this->userId)->get();
$subtotal = 0;
$itemsTransformed = $items->map(function ($it) use (&$subtotal) {
$line = [
'id' => $it->id,
'product_id' => $it->product_id,
'product_name' => $it->product->name,
'quantity' => $it->quantity,
'price' => $it->price,
'line_total' => round($it->price * $it->quantity, 2),
];
$subtotal += $line['line_total'];
return $line;
});


return response()->json([
'items' => $itemsTransformed,
'subtotal' => round($subtotal, 2),
'currency' => 'INR',
]);
}

public function add(Request $request)
{
$request->validate([
'product_id' => 'required|exists:products,id',
'quantity' => 'nullable|integer|min:1'
]);


$product = Product::findOrFail($request->product_id);
$quantity = $request->quantity ?? 1;


$item = CartItem::where('user_id', $this->userId)
->where('product_id', $product->id)
->first();


if ($item) {
$item->quantity += $quantity;
$item->price = $product->price;
$item->save();
} else {
$item = CartItem::create([
'user_id' => $this->userId,
'product_id' => $product->id,
'quantity' => $quantity,
'price' => $product->price,
]);
}


return response()->json(['message' => 'Added to cart', 'item' => $item], 201);
}

public function update(Request $request, $id)
{
$request->validate([
'quantity' => 'required|integer|min:1'
]);


$item = CartItem::where('user_id', $this->userId)->where('id', $id)->firstOrFail();
$item->quantity = $request->quantity;
$item->save();


return response()->json(['message' => 'Cart updated', 'item' => $item]);
}

public function delete($id)
{
$item = CartItem::where('user_id', $this->userId)->where('id', $id)->firstOrFail();
$item->delete();
return response()->json(['message' => 'Cart item removed']);
}
}
