<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;


Route::get('/auth/login', [AuthController::class, 'loginIndex'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/auth/register', [AuthController::class, 'registerIndex'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/detail/{slug}', [ProductController::class, 'show'])->name('product.detail');
Route::get('/training', [TrainingController::class, 'index'])->name('training');
Route::get('/training/detail/{slug}', [TrainingController::class, 'detail'])->name('training.detail');

Route::middleware('auth.customer')->group(function () {
    Route::get('/account/setting', [CustomerController::class, 'index'])->name('setting');
    Route::get('/account/transaction', [OrderController::class, 'transaction'])->name('transaction');
    Route::post('/account/update-detail', [CustomerController::class, 'updateDetail'])->name('setting.update.detail');
    Route::post('/account/update-password', [CustomerController::class, 'updatePassword'])->name('setting.update.password');
    Route::post('/account/update-profile', [CustomerController::class, 'updateProfile'])->name('setting.update.profile');
    Route::post('/account/delete-profile', [CustomerController::class, 'deleteProfile'])->name('setting.delete.profile');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/items/{id}', [CartController::class, 'destroy'])->name('cart.item.destroy');
    Route::patch('/cart-items/{id}/quantity', [CartItemController::class, 'updateQuantity'])->name('cart-items.updateQuantity');

    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('checkout');
});
