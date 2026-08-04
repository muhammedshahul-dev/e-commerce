<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

Route::resource('cart',CartController::class)->except('create','show','edit')->middleware(['auth']);
// Protected admin/staff CRUD routes
Route::middleware(['auth'])->group(function () {
    Route::resource('product', ProductController::class)->except(['index', 'show','create']);
});
// Public route
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');




require __DIR__.'/settings.php';
