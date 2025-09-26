@extends('user.layout')
@section('title','Products')

@section('content')
<h2>Products</h2>
<div class="row">
    @foreach($products as $product)
    <div class="col-md-4">
        <div class="card mb-3">
            @if($product->images->count())
                <img src="{{ asset('storage/'.$product->images->first()->file_path) }}" class="card-img-top" alt="">
            @endif
            <div class="card-body">
                <h5>{{ $product->name }}</h5>
                <p>Price: ₹{{ $product->price }}</p>
                <a href="{{ route('user.products.show', $product->id) }}" class="btn btn-primary">View</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
