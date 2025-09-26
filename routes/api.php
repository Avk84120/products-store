<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\CheckoutApiController;


Route::get('/products', [ProductApiController::class, 'index']);


Route::prefix('cart')->group(function () {
Route::get('/', [CartApiController::class, 'list']);
Route::post('/add', [CartApiController::class, 'add']);
Route::put('/{id}', [CartApiController::class, 'update']);
Route::delete('/{id}', [CartApiController::class, 'delete']);
});


Route::post('/checkout', [CheckoutApiController::class, 'checkout']);