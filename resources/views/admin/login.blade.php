@extends('admin.layout')


@section('title','Login')


@section('content')
<div class="row justify-content-center">
<div class="col-md-5">
<div class="card">
<div class="card-body">
<h3 class="card-title">Admin Login</h3>
<form method="POST" action="{{ route('admin.login.submit') }}">
@csrf
<div class="mb-3">
<label>Email</label>
<input class="form-control" name="email" type="email" required>
</div>
<div class="mb-3">
<label>Password</label>
<input class="form-control" name="password" type="password" required>
</div>
<button class="btn btn-primary">Login</button>
</form>
</div>
</div>
</div>
</div>
@endsection