<!DOCTYPE html>
<html>
<head>
    <title>User Panel - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('user.dashboard') }}">User Panel</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item"><a class="nav-link" href="{{ route('user.products.index') }}">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('user.cart.index') }}">Cart</a></li>
          <li class="nav-item">
            <form method="POST" action="{{ route('user.logout') }}">
              @csrf
              <button class="btn btn-link nav-link">Logout</button>
            </form>
          </li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('user.login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('user.register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-4">
    @yield('content')
</div>
</body>
</html>
