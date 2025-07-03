<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', function(){return view('pages.product.products');})->name('products');
Route::get('/search', function(){return view('pages.product.search');})->name('products.search');
Route::get('/products/detail', function(){return view('pages.product.detail');})->name('product.detail');
