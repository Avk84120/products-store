@extends('admin.layout')
@section('title','Orders')
@section('content')
<h2>Orders</h2>
<table class="table table-bordered">
<thead>
<tr>
    <th>ID</th>
    <th>User</th>
    <th>Total Amount</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
@foreach($orders as $order)
<tr>
    <td>{{ $order->id }}</td>
    <td>{{ $order->user->email }}</td>
    <td>₹{{ $order->total_amount }}</td>
    <td>{{ ucfirst($order->status) }}</td>
    <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a></td>
</tr>
@endforeach
</tbody>
</table>
@endsection
