@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">✏ Edit Product</h2>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Form -->
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
        </div>

        <!-- Product Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price (₹)</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" class="form-control" required>
        </div>

        <!-- Upload New Images -->
        <div class="mb-3">
            <label for="images" class="form-label">Add New Images (optional)</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <!-- Current Images -->
        <div class="mb-3">
            <label class="form-label">Current Images</label>
            <div class="d-flex flex-wrap">
                @foreach ($product->images as $image)
                    <div class="position-relative m-2">
                        <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image"
                             class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                        
                        <!-- Delete Checkbox -->
                        <div class="form-check mt-1 text-center">
                            <input class="form-check-input" type="checkbox" name="remove_images[]" value="{{ $image->id }}">
                            <label class="form-check-label">Remove</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-success">Update Product</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
