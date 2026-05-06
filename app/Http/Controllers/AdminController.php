<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;

class AdminController extends Controller
{
    public function dashboard()
    {
        $purchases = Purchase::with('items')->latest()->get();
        $products = Product::orderBy('stock')->get();

        return view('admindashboard', compact('purchases', 'products'));
    }
}
