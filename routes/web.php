<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/auth/login', [AuthController::class, 'loginIndex'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/auth/register', [AuthController::class, 'registerIndex'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/detail/{slug}', [ProductController::class, 'show'])->name('product.detail');

Route::get('/search', function () {
    return view('pages.product.search');
})->name('products.search');

Route::get('/account/setting', [CustomerController::class, 'index'])->name('setting');
Route::post('/account/update-detail', [CustomerController::class, 'updateDetail'])->name('setting.update.detail');
Route::post('/account/update-password', [CustomerController::class, 'updatePassword'])->name('setting.update.password');
