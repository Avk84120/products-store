@extends('user.layout')
@section('title','Dashboard')
@section('content')
<h1>Welcome, {{ auth()->user()->name }}</h1>
<p>Quick links:</p>
<a href="{{ route('user.products.index') }}" class="btn btn-primary">Manage Products</a>
<a href="{{ route('user.orders.index') }}" class="btn btn-secondary">View Orders</a>
@endsection