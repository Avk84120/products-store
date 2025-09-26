<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;

class UserCartController extends Controller
{
    public function index()
    {
        $items = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $items->sum(fn($i) => $i->price * $i->quantity);

        return view('user.cart.index', compact('items', 'total'));
    }

    public function add($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $item = CartItem::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $id],
            ['quantity' => \DB::raw('quantity + 1'), 'price' => $product->price]
        );

        return redirect()->route('user.cart.index')->with('success', 'Product added to cart.');
    }

    public function remove($id)
    {
        CartItem::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->route('user.cart.index')->with('success', 'Item removed.');
    }
}
