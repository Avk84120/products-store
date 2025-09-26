@extends('admin.layout')
@section('title','Add Product')
@section('content')
<h2>Add Product</h2>
<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
@csrf
<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>
<div class="mb-3">
<label>Description</label>
<textarea name="description" class="form-control"></textarea>
</div>
<div class="mb-3">
<label>Price</label>
<input type="number" step="0.01" name="price" class="form-control" required>
</div>
<div class="mb-3">
<label>Stock</label>
<input type="number" name="stock" class="form-control">
</div>
<div class="mb-3">
<label>Images (multiple)</label>
<input type="file" name="images[]" multiple class="form-control">
</div>
<button class="btn btn-success">Create Product</button>
</form>
@endsection