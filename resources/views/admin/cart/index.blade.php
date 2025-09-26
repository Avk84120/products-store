@extends('admin.layout')
@section('title','Cart Items')
@section('content')
<h2>Cart items (user id = 1)</h2>
<table class="table">
<thead><tr><th>ID</th><th>User</th><th>Product</th><th>Qty</th><th>Price</th><th>Line Total</th></tr></thead>
<tbody>
@foreach($items as $it)
<tr>
<td>{{ $it->id }}</td>
<td>{{ $it->user->email }}</td>
<td>{{ $it->product->name }}</td>
<td>{{ $it->quantity }}</td>
<td>{{ $it->price }}</td>
<td>{{ $it->price * $it->quantity }}</td>
</tr>
@endforeach
</tbody>
</table>
@endsection