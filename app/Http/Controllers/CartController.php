<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartIds = $request->session()->get('cart', []);
        $products = Product::whereIn('id', $cartIds)
            ->where('stock', '>', 0)
            ->get();
        $selectedSizes = $request->session()->get('selected_sizes', []);

        return view('addtocart', compact('products', 'selectedSizes'));
    }

    public function store(Request $request, Product $product)
    {
        if ($product->stock <= 0) {
            return back()->with('status', "{$product->name} is out of stock.");
        }

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
        $cart = $request->session()->get('cart', []);
        $inStockIds = Product::whereIn('id', $cart)
            ->where('stock', '>', 0)
            ->pluck('id')
            ->all();

        if (empty($inStockIds)) {
            return redirect('/products')->with('status', 'Please select in-stock products before checkout.');
        }

        $validated = $request->validate([
            'sizes' => ['required', 'array'],
            'sizes.*' => ['required', 'in:41,42,43,44'],
        ]);

        $selectedSizes = [];
        foreach ($inStockIds as $productId) {
            if (empty($validated['sizes'][$productId])) {
                return back()->withErrors(['sizes' => 'Please choose a shoe size for every cart item.']);
            }

            $selectedSizes[$productId] = $validated['sizes'][$productId];
        }

        $request->session()->put('checkout_product_ids', $inStockIds);
        $request->session()->put('checkout_source', 'cart');
        $request->session()->put('selected_sizes', $selectedSizes);
        $request->session()->forget('selected_size');

        return redirect('/checkout');
    }
}
