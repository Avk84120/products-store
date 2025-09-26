<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use Razorpay\Api\Api;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class UserCheckoutController extends Controller
{
    public function checkout()
    {
        $items = CartItem::with('product')->where('user_id', Auth::id())->get();
        $total = $items->sum(fn($i) => $i->price * $i->quantity);

        return view('user.checkout.index', compact('items', 'total'));
    }

    public function pay(Request $request)
    {
        $items = CartItem::with('product')->where('user_id', Auth::id())->get();
        $total = $items->sum(fn($i) => $i->price * $i->quantity);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => 'order_rcpt_' . time(),
            'amount' => $total * 100, // amount in paise
            'currency' => 'INR',
        ]);

        session(['razorpay_order_id' => $order['id']]);

        return view('user.checkout.pay', compact('order', 'items', 'total'));
    }

    public function success(Request $request)
{
    $userId = Auth::id();
    $items = CartItem::with('product')->where('user_id', $userId)->get();
    $total = $items->sum(fn($i) => $i->price * $i->quantity);

    // Create Order
    $order = Order::create([
        'user_id' => $userId,
        'total_amount' => $total,
        'payment_id' => $request->razorpay_payment_id ?? null,
        'status' => 'paid'
    ]);

    // Create Order Items
    foreach($items as $item){
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->price
        ]);
    }

    // Clear Cart
    CartItem::where('user_id', $userId)->delete();

    return redirect()->route('user.dashboard')->with('success', 'Payment successful and order placed!');
}
}
