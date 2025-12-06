<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonatController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;

// AUTH
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// HOME
Route::get('/', [HomeController::class, 'index'])->name('home');

// DONAT Public User
Route::get('/donat', [DonatController::class, 'index'])->name('donat.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

// CART
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout (User)
Route::get('/checkout', [TransaksiController::class, 'checkout'])->name('checkout');
Route::post('/checkout/proses', [TransaksiController::class, 'prosesCheckout'])->name('checkout.proses');

// ADMIN AREA (Protected)
Route::middleware(['auth'])->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// CRUD Donat
Route::get('/donat/create', [DonatController::class, 'create'])->name('donat.create');
Route::post('/donat/store', [DonatController::class, 'store'])->name('donat.store');
Route::get('/donat/edit/{id}', [DonatController::class, 'edit'])->name('donat.edit');
Route::post('/donat/update/{id}', [DonatController::class, 'update'])->name('donat.update');
Route::delete('/donat/delete/{id}', [DonatController::class, 'destroy'])->name('donat.delete');

// Transaksi + Invoice
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/invoice/{id}', [TransaksiController::class, 'invoice'])->name('transaksi.invoice');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

});