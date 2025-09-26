<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Product;


class ProductApiController extends Controller
{
public function index()
{
$products = Product::with('images')->get()->map(function ($p) {
return [
'id' => $p->id,
'name' => $p->name,
'description' => $p->description,
'price' => $p->price,
'stock' => $p->stock,
'images' => $p->images->map(function ($img) {
return asset('storage/' . $img->file_path);
})->toArray(),
];
});


return response()->json(['data' => $products]);
}
}