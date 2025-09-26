<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;


class CheckoutApiController extends Controller
{
protected $userId = 1;


public function checkout(Request $request)
{
$items = CartItem::with('product')->where('user_id', $this->userId)->get();
if ($items->isEmpty()) {
return response()->json(['message' => 'Cart is empty'], 400);
}


$total = 0;
foreach ($items as $it) {
$total += ($it->price * $it->quantity);
}


DB::beginTransaction();
try {
$order = Order::create([
'user_id' => $this->userId,
'total_amount' => $total,
'status' => 'pending',
]);


foreach ($items as $it) {
OrderItem::create([
'order_id' => $order->id,
'product_id' => $it->product_id,
'quantity' => $it->quantity,
'price' => $it->price,
]);
}


// Optionally: integrate payment gateway here. Example (Razorpay):
// $api = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
// $razorpayOrder = $api->order->create(['amount' => $total*100, 'currency' => 'INR']);
// Save razorpay order id to DB if needed


// Clear cart
CartItem::where('user_id', $this->userId)->delete();


DB::commit();


return response()->json(['message' => 'Order created', 'order_id' => $order->id]);
} catch (\Exception $e) {
DB::rollBack();
return response()->json(['message' => 'Checkout failed', 'error' => $e->getMessage()], 500);
}
}
}