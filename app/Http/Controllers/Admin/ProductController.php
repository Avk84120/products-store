<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
public function index()
{
$products = Product::with('images')->paginate(12);
return view('admin.products.index', compact('products'));
}


public function create()
{
return view('admin.products.create');
}


public function store(Request $request)
{
$request->validate([
'name' => 'required|string|max:255',
'price' => 'required|numeric',
'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120'
]);


DB::beginTransaction();
try {
$product = Product::create($request->only(['name','description','price','stock']));


if ($request->hasFile('images')) {
foreach ($request->file('images') as $index => $image) {
$path = $image->store('products', 'public');
$product->images()->create([
'file_path' => $path,
'is_primary' => $index === 0,
]);
}
}
DB::commit();
return redirect()->route('admin.products.index')->with('success', 'Product created');
} catch (\Exception $e) {
DB::rollBack();
return back()->withErrors(['error' => $e->getMessage()]);
}
}


public function edit(Product $product)
{
$product->load('images');
return view('admin.products.edit', compact('product'));
}


public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // Update product basic details
    $product->update([
        'name' => $request->name,
        'price' => $request->price,
    ]);

    // Remove selected images
    if ($request->has('remove_images')) {
        foreach ($request->remove_images as $imageId) {
            $image = $product->images()->find($imageId);
            if ($image) {
                \Storage::delete($image->file_path);
                $image->delete();
            }
        }
    }

    // Upload new images
    if ($request->hasFile('images')) {
    foreach ($request->file('images') as $file) {
        $path = $file->store('products', 'public');
        $product->images()->create([
            'file_path' => $path  
        ]);
    }
}


    return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
}



public function destroy(Product $product)
{
$product->delete();
return back()->with('success', 'Product deleted');
}
}