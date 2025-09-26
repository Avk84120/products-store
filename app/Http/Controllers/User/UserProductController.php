<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class UserProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->get();
        return view('user.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('user.products.show', compact('product'));
    }
}
