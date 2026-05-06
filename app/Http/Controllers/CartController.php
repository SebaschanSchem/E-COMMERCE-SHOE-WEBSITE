<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartIds = $request->session()->get('cart', []);
        $products = Product::whereIn('id', $cartIds)->get();

        return view('addtocart', compact('products'));
    }

    public function store(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);

        if (! in_array($product->id, $cart, true)) {
            $cart[] = $product->id;
        }

        $request->session()->put('cart', $cart);

        return back()->with('status', "{$product->name} added to cart.");
    }

    public function remove(Request $request, Product $product)
    {
        $cart = array_values(array_filter(
            $request->session()->get('cart', []),
            fn ($id) => (int) $id !== $product->id
        ));

        $request->session()->put('cart', $cart);

        return back()->with('status', "{$product->name} removed from cart.");
    }

    public function purchaseAll(Request $request)
    {
        $request->session()->put('checkout_product_ids', $request->session()->get('cart', []));

        return redirect('/checkout');
    }
}
