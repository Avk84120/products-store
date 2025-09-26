@extends('admin.layout')
@section('title','Order Details')
@section('content')
<h2>Order #{{ $order->id }}</h2>
<p>User: {{ $order->user->name }} ({{ $order->user->email }})</p>
<p>Status: {{ ucfirst($order->status) }}</p>
<p>Total: ₹{{ $order->total_amount }}</p>

<h4>Items</h4>
<table class="table table-bordered">
<thead>
<tr>
    <th>Product</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Total</th>
</tr>
</thead>
<tbody>
@foreach($order->items as $item)
<tr>
    <td>{{ $item->product->name }}</td>
    <td>{{ $item->quantity }}</td>
    <td>{{ $item->price }}</td>
    <td>{{ $item->quantity * $item->price }}</td>
</tr>
@endforeach
</tbody>
</table>
@endsection
