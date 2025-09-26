<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\AuthController;
// use App\Http\Controllers\User\UserAuthController;
// use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserCheckoutController;
use App\Http\Controllers\User\UserOrderController;



Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Auth
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Products CRUD
    Route::resource('products', ProductController::class);

    // Orders CRUD
    Route::resource('orders', OrderController::class)->only(['index', 'show']);

    // Cart
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
});
// User Authentication


Route::prefix('user')->name('user.')->group(function () {
    // Auth
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserAuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserAuthController::class, 'register'])->name('register.submit');
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::get('/products', [UserProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [UserProductController::class, 'show'])->name('products.show');
    Route::resource('orders', OrderController::class)->only(['index', 'show']);

    // Cart
    Route::get('/cart', [UserCartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [UserCartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{id}', [UserCartController::class, 'remove'])->name('cart.remove');

     Route::get('/checkout', [UserCheckoutController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/pay', [UserCheckoutController::class, 'pay'])->name('checkout.pay');   // <-- THIS
    Route::get('/checkout/success', [UserCheckoutController::class, 'success'])->name('checkout.success');

    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [UserOrderController::class, 'show'])->name('orders.show');
});


