<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::view('/login', 'login');
Route::view('/home', 'home');
Route::view('/product', 'product');
Route::view('/purchase', 'purchase');
Route::view('/cod', 'cod');
Route::view('/addtocart', 'addtocart');
Route::view('/admindashboard', 'admindashboard');
Route::view('/adminproduct', 'adminproduct');