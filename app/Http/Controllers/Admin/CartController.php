<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem; // or your correct model name

class CartController extends Controller
{
    public function index()
    {
        // Example: fetch all cart items for user_id = 1
        $items = CartItem::with(['user', 'product'])->where('user_id', 1)->get();

        return view('admin.cart.index', compact('items'));
    }
}
