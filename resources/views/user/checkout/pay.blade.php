@extends('user.layout')
@section('title','Pay Now')

@section('content')
<h2>Complete Payment</h2>

<form action="{{ route('user.checkout.success') }}" method="GET">
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="{{ env('RAZORPAY_KEY') }}"
    data-amount="{{ $total * 100 }}"
    data-currency="INR"
    data-order_id="{{ $order['id'] }}"
    data-buttontext="Pay ₹{{ $total }}"
    data-name="My Shop"
    data-description="Order Payment"
    data-prefill.name="{{ auth()->user()->name }}"
    data-prefill.email="{{ auth()->user()->email }}"
    data-theme.color="#28a745">
</script>
<input type="hidden" custom="Hidden Element" name="hidden">
</form>
@endsection
