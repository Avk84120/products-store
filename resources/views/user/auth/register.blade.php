@extends('user.layout')
@section('title','Register')

@section('content')
<h2>User Register</h2>
<form method="POST" action="{{ route('user.register.submit') }}">
    @csrf
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
    <button class="btn btn-success">Register</button>
</form>
@endsection
