@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <h3 class="text-center mb-4">🔑 User Login</h3>

        <!-- Show Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('user.login.submit') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">📧 Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">🔒 Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-100">Login</button>

            <!-- Register Link -->
            <div class="text-center mt-3">
                <a href="{{ route('user.register') }}">Don’t have an account? Register</a>
            </div>
        </form>
    </div>
</div>
@endsection
