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
        $selectedQuantities = $request->session()->get('cart_quantities', []);

        return view('addtocart', compact('products', 'selectedSizes', 'selectedQuantities'));
    }

    public function store(Request $request, Product $product)
    {
        if ($product->stock <= 0) {
            return back()->with('status', "{$product->name} is out of stock.");
        }

        $validated = $request->validate([
            'quantity' => ['sometimes', 'required', 'integer', 'min:1', 'max:99'],
        ]);

        $quantity = (int) ($validated['quantity'] ?? 1);

        if ($quantity > $product->stock) {
            return back()
                ->withErrors(['quantity' => 'Quantity cannot be greater than available stock.'])
                ->withInput();
        }

        $cart = $request->session()->get('cart', []);
        $cartQuantities = $request->session()->get('cart_quantities', []);

        if (! in_array($product->id, $cart, true)) {
            $cart[] = $product->id;
        }

        $cartQuantities[$product->id] = $quantity;

        $request->session()->put('cart', $cart);
        $request->session()->put('cart_quantities', $cartQuantities);

        return back()->with('status', "{$product->name} added to cart.");
    }

    public function remove(Request $request, Product $product)
    {
        $cart = array_values(array_filter(
            $request->session()->get('cart', []),
            fn ($id) => (int) $id !== $product->id
        ));

        $request->session()->put('cart', $cart);
        $cartQuantities = $request->session()->get('cart_quantities', []);
        $selectedSizes = $request->session()->get('selected_sizes', []);

        unset($cartQuantities[$product->id], $selectedSizes[$product->id]);

        $request->session()->put('cart_quantities', $cartQuantities);
        $request->session()->put('selected_sizes', $selectedSizes);

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
            'quantities' => ['required', 'array'],
            'quantities.*' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $selectedSizes = [];
        $selectedQuantities = [];
        $products = Product::whereIn('id', $inStockIds)->get()->keyBy('id');

        foreach ($inStockIds as $productId) {
            if (empty($validated['sizes'][$productId])) {
                return back()->withErrors(['sizes' => 'Please choose a shoe size for every cart item.']);
            }

            if (empty($validated['quantities'][$productId])) {
                return back()->withErrors(['quantities' => 'Please choose a quantity for every cart item.']);
            }

            $quantity = (int) $validated['quantities'][$productId];
            $product = $products[$productId] ?? null;

            if (! $product || $quantity > $product->stock) {
                return back()
                    ->withErrors(['quantities' => 'Quantity cannot be greater than available stock.'])
                    ->withInput();
            }

            $selectedSizes[$productId] = $validated['sizes'][$productId];
            $selectedQuantities[$productId] = $quantity;
        }

        $request->session()->put('checkout_product_ids', $inStockIds);
        $request->session()->put('checkout_source', 'cart');
        $request->session()->put('selected_sizes', $selectedSizes);
        $request->session()->put('selected_quantities', $selectedQuantities);
        $request->session()->forget(['selected_size', 'selected_quantity']);

        return redirect('/checkout');
    }
}
