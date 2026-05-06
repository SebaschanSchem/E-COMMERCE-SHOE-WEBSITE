<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLogin']);

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/home', [HomeController::class, 'index']);

Route::get('/products', [ProductController::class, 'index']);
Route::redirect('/product', '/products');

Route::get('/purchase/{product}', [PurchaseController::class, 'show']);
Route::get('/purchase', fn () => redirect('/products'));

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/purchase-all', [CartController::class, 'purchaseAll']);
Route::post('/cart/{product}', [CartController::class, 'store']);
Route::delete('/cart/{product}', [CartController::class, 'remove']);
Route::redirect('/addtocart', '/cart');

Route::get('/checkout', [PurchaseController::class, 'checkout']);
Route::post('/checkout', [PurchaseController::class, 'placeOrder']);
Route::redirect('/cod', '/checkout');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/products', [ProductController::class, 'adminIndex']);
Route::post('/admin/products', [ProductController::class, 'store']);
Route::put('/admin/products/{product}', [ProductController::class, 'update']);
Route::delete('/admin/products/{product}', [ProductController::class, 'destroy']);
Route::redirect('/admindashboard', '/admin/dashboard');
Route::redirect('/adminproduct', '/admin/products');
