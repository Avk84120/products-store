@extends('user.layout')
@section('title','Checkout')

@section('content')
<h2>Checkout</h2>

@if($items->count())
<table class="table">
<thead>
<tr>
    <th>Product</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Total</th>
</tr>
</thead>
<tbody>
@foreach($items as $it)
<tr>
    <td>{{ $it->product->name }}</td>
    <td>{{ $it->quantity }}</td>
    <td>{{ $it->price }}</td>
    <td>{{ $it->price * $it->quantity }}</td>
</tr>
@endforeach
<tr>
    <td colspan="3" class="text-end"><strong>Total:</strong></td>
    <td>₹{{ $total }}</td>
</tr>
</tbody>
</table>

<form method="POST" action="{{ route('user.checkout.pay') }}">
    @csrf
    <button class="btn btn-success">Pay with Razorpay</button>
</form>

@else
<p>No items in cart.</p>
@endif
@endsection
