@extends('admin.layout')
@section('title','Products')
@section('content')
<div class="d-flex justify-content-between mb-3">
<h2>Products</h2>
<a href="{{ route('admin.products.create') }}" class="btn btn-success">Add Product</a>
</div>


<table class="table table-striped">
<thead>
<tr><th>ID</th><th>Name</th><th>Price</th><th>Images</th><th>Actions</th></tr>
</thead>
<tbody>
@foreach($products as $p)
<tr>
<td>{{ $p->id }}</td>
<td>{{ $p->name }}</td>
<td>{{ $p->price }}</td>
<td>
@foreach($p->images as $img)
<img src="{{ asset('storage/'.$img->file_path) }}" style="height:40px;margin-right:6px;" />
@endforeach
</td>
<td>
<a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-primary">Edit</a>
<form method="POST" action="{{ route('admin.products.destroy', $p) }}" style="display:inline">@csrf @method('DELETE')
<button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>


{{ $products->links() }}
@endsection