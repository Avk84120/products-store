@extends('user.layout')
@section('title','Cart')

@section('content')
<h2>Your Cart</h2>

@if($items->count())
<table class="table">
<thead>
<tr>
    <th>Product</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Total</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
@foreach($items as $it)
<tr>
    <td>{{ $it->product->name }}</td>
    <td>{{ $it->quantity }}</td>
    <td>{{ $it->price }}</td>
    <td>{{ $it->price * $it->quantity }}</td>
    <td>
        <form method="POST" action="{{ route('user.cart.remove', $it->id) }}">
            @csrf
            <button class="btn btn-danger btn-sm">Remove</button>
        </form>
    </td>
</tr>
@endforeach
<tr>
    <td colspan="3" class="text-end"><strong>Total:</strong></td>
    <td colspan="2">₹{{ $total }}</td>
</tr>
</tbody>
</table>
@else
<p>No items in cart.</p>
@endif
@endsection
