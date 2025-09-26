@extends('user.layout')
@section('title','Product Details')

@section('content')
<h2>{{ $product->name }}</h2>
<p>Price: ₹{{ $product->price }}</p>

<div class="mb-3">
    @foreach($product->images as $img)
        <img src="{{ asset('storage/'.$img->file_path) }}" width="150" class="me-2 mb-2">
    @endforeach
</div>

<form method="POST" action="{{ route('user.cart.add', $product->id) }}">
    @csrf
    <button class="btn btn-success">Add to Cart</button>
</form>
@endsection
