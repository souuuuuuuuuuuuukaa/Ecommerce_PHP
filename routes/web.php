<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');



// Panier
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Paiement
Route::get('/checkout', [PaymentController::class, 'showPaymentPage'])->name('checkout');
Route::get('/payment/success/{orderId}', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/failed/{orderId}', [PaymentController::class, 'failed'])->name('payment.failed');
Route::post('/payzone/callback', [PaymentController::class, 'callback'])->name('payzone.callback');
Route::post('/payment/launch', [PaymentController::class, 'launch'])->name('payzone.launch');


Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Auth routes (si Breeze/Fortify/Jetstream est utilisé)
require __DIR__ . '/auth.php';
