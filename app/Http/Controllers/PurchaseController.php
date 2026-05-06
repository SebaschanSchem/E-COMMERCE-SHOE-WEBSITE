<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function show(Request $request, Product $product)
    {
        $request->session()->put('checkout_product_ids', [$product->id]);

        return view('purchase', compact('product'));
    }

    public function checkout(Request $request)
    {
        $ids = $request->session()->get('checkout_product_ids', []);

        if (empty($ids)) {
            $ids = $request->session()->get('cart', []);
        }

        $products = Product::whereIn('id', $ids)->get();
        $total = $products->sum(fn ($product) => (float) $product->price);
        $checkoutDetails = $request->session()->get('checkout_details');
        $canEdit = $request->boolean('edit') || empty($checkoutDetails);

        return view('cod', compact('products', 'total', 'checkoutDetails', 'canEdit'));
    }

    public function placeOrder(Request $request)
    {
        $ids = $request->session()->get('checkout_product_ids', $request->session()->get('cart', []));
        $products = Product::whereIn('id', $ids)->get();

        if ($products->isEmpty()) {
            return redirect('/products')->with('status', 'Please select products before checkout.');
        }

        $existingDetails = $request->session()->get('checkout_details');
        $details = $existingDetails ?: $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:1000'],
            'contact_number' => ['required', 'string', 'max:30'],
        ]);

        if ($request->boolean('allow_update')) {
            $details = $request->validate([
                'full_name' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:1000'],
                'contact_number' => ['required', 'string', 'max:30'],
            ]);
        }

        $purchase = DB::transaction(function () use ($products, $details) {
            $purchase = Purchase::create([
                ...$details,
                'total_price' => $products->sum(fn ($product) => (float) $product->price),
                'payment_method' => 'Cash on Delivery',
            ]);

            foreach ($products as $product) {
                $purchase->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'unit_price' => $product->price,
                    'quantity' => 1,
                    'subtotal' => $product->price,
                ]);

                if ($product->stock > 0) {
                    $product->decrement('stock');
                }
            }

            return $purchase;
        });

        $request->session()->put('checkout_details', $details);
        $request->session()->forget(['checkout_product_ids', 'cart']);

        return redirect('/checkout')->with('status', "Purchase #{$purchase->id} placed with COD.");
    }
}
