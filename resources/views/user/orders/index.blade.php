@extends('user.layout')
@section('title','My Orders')

@section('content')
<h2>My Orders</h2>

@if($orders->count())
<table class="table table-bordered">
<thead>
<tr>
    <th>Order ID</th>
    <th>Date</th>
    <th>Total Amount</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
@foreach($orders as $order)
<tr>
    <td>{{ $order->id }}</td>
    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
    <td>₹{{ $order->total_amount }}</td>
    <td>{{ ucfirst($order->status) }}</td>
    <td><a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a></td>
</tr>
@endforeach
</tbody>
</table>
@else
<p>You have no orders yet.</p>
@endif
@endsection
