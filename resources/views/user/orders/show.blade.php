@extends('user.layout')
@section('title','Order Details')

@section('content')
<h2>Order #{{ $order->id }}</h2>
<p>Date: {{ $order->created_at->format('d-m-Y H:i') }}</p>
<p>Status: {{ ucfirst($order->status) }}</p>
<p>Total Amount: ₹{{ $order->total_amount }}</p>

<h4>Items</h4>
<table class="table table-bordered">
<thead>
<tr>
    <th>Product</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Subtotal</th>
</tr>
</thead>
<tbody>
@foreach($order->items as $item)
<tr>
    <td>{{ $item->product->name }}</td>
    <td>{{ $item->quantity }}</td>
    <td>₹{{ $item->price }}</td>
    <td>₹{{ $item->quantity * $item->price }}</td>
</tr>
@endforeach
</tbody>
</table>

<a href="{{ route('user.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
@endsection
