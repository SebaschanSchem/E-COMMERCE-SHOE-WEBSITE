<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    private const SHOE_SIZES = ['41', '42', '43', '44'];

    public function show(Request $request, Product $product)
    {
        if ($product->stock <= 0) {
            return redirect('/products')->with('status', 'This product is out of stock.');
        }

        $request->session()->put('checkout_product_ids', [$product->id]);
        $request->session()->put('checkout_source', 'direct');

        return view('purchase', compact('product'));
    }

    public function checkout(Request $request)
    {
        if ($request->has('size')) {
            $validated = $request->validate([
                'size' => ['required', 'in:' . implode(',', self::SHOE_SIZES)],
            ]);

            $request->session()->put('selected_size', $validated['size']);
            $checkoutProductIds = $request->session()->get('checkout_product_ids', []);

            if (! empty($checkoutProductIds)) {
                $request->session()->put('selected_sizes', [
                    $checkoutProductIds[0] => $validated['size'],
                ]);
            }
        }

        $ids = $request->session()->get('checkout_product_ids', []);
        $isDirectPurchase = $request->session()->get('checkout_source') === 'direct';

        if (empty($ids)) {
            $ids = $request->session()->get('cart', []);
        }

        $hasSelectedProducts = ! empty($ids);
        $products = Product::whereIn('id', $ids)
            ->where('stock', '>', 0)
            ->get();

        if ($hasSelectedProducts && $products->isEmpty()) {
            return redirect('/products')->with('status', 'Please select an in-stock product before checkout.');
        }

        $selectedSize = $request->session()->get('selected_size');
        $selectedSizes = $request->session()->get('selected_sizes', []);

        if ($isDirectPurchase && ! in_array($selectedSize, self::SHOE_SIZES, true)) {
            return redirect('/purchase/' . $ids[0])
                ->withErrors(['size' => 'Please choose a shoe size before purchasing.']);
        }

        $total = $products->sum(fn ($product) => (float) $product->price);
        $checkoutDetails = $request->session()->get('checkout_details');
        $canEdit = $request->boolean('edit') || empty($checkoutDetails);

        return view('cod', compact('products', 'total', 'checkoutDetails', 'canEdit', 'selectedSize', 'selectedSizes'));
    }

    public function placeOrder(Request $request)
    {
        $ids = $request->session()->get('checkout_product_ids', $request->session()->get('cart', []));
        $isDirectPurchase = $request->session()->get('checkout_source') === 'direct';
        $products = Product::whereIn('id', $ids)
            ->where('stock', '>', 0)
            ->get();

        if ($products->isEmpty()) {
            return redirect('/products')->with('status', 'Please select in-stock products before checkout.');
        }

        $selectedSize = $request->session()->get('selected_size');
        $selectedSizes = $request->session()->get('selected_sizes', []);

        if ($isDirectPurchase && ! in_array($selectedSize, self::SHOE_SIZES, true)) {
            return redirect('/purchase/' . $ids[0])
                ->withErrors(['size' => 'Please choose a shoe size before purchasing.']);
        }

        $existingDetails = $request->session()->get('checkout_details');
        $details = $existingDetails ?: $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:1000'],
            'contact_number' => ['required', 'regex:/^09\d{9}$/'],
        ]);

        if ($request->boolean('allow_update')) {
            $details = $request->validate([
                'full_name' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:1000'],
                'contact_number' => ['required', 'regex:/^09\d{9}$/'],
            ]);
        }

        $purchase = DB::transaction(function () use ($ids, $details, $selectedSize, $selectedSizes) {
            $products = Product::whereIn('id', $ids)
                ->where('stock', '>', 0)
                ->lockForUpdate()
                ->get();

            if ($products->isEmpty()) {
                throw new \Illuminate\Http\Exceptions\HttpResponseException(
                    redirect('/products')->with('status', 'Selected products are out of stock.')
                );
            }

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
                    'size' => $selectedSizes[$product->id] ?? $selectedSize,
                    'subtotal' => $product->price,
                ]);

                $product->decrement('stock');
            }

            return $purchase;
        });

        $request->session()->put('checkout_details', $details);
        $request->session()->forget(['checkout_product_ids', 'checkout_source', 'cart', 'selected_size', 'selected_sizes']);

       $productNames = $products->pluck('name')->implode(', ');

return redirect('/checkout')->with(
    'status',
    "Successfully purchased: {$productNames}"
);
    }
}
