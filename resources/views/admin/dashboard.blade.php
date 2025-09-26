@extends('admin.layout')
@section('title','Dashboard')
@section('content')
<h1>Welcome, Admin</h1>
<p>Quick links:</p>
<a href="{{ route('admin.products.index') }}" class="btn btn-primary">Manage Products</a>
<a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Orders</a>
@endsection