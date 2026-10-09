<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/produk'));

Route::get('/produk', [ProductController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/keranjang',            [CartController::class, 'index']);
    Route::post('/keranjang/tambah',    [CartController::class, 'tambah']);
    Route::post('/keranjang/update',    [CartController::class, 'update']);
    Route::post('/keranjang/hapus',     [CartController::class, 'hapus']);
    Route::post('/keranjang/kosongkan', [CartController::class, 'kosongkan']);

    Route::get('/checkout',         [OrderController::class, 'checkout']);
    Route::post('/checkout/proses', [OrderController::class, 'store']);
    Route::get('/pesanan',          [OrderController::class, 'index']);
    Route::get('/pesanan/{id}',     [OrderController::class, 'show']);
});
