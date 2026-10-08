<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/index'));
Route::get('/index',             [CartController::class, 'index']);
Route::get('/keranjang',         [CartController::class, 'keranjang']);
Route::post('/keranjang/tambah', [CartController::class, 'tambah']);
Route::post('/keranjang/update', [CartController::class, 'update']);
Route::post('/keranjang/hapus',  [CartController::class, 'hapus']);
Route::post('/keranjang/kosongkan', [CartController::class, 'kosongkan']);
