<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('stock', '>', 0)->latest()->take(3)->get();

        return view('home', compact('featuredProducts'));
    }
}
