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
            $checkoutProductIds = $request->session()->get('checkout_product_ids', []);
            $checkoutProduct = Product::find($checkoutProductIds[0] ?? null);

            $validated = $request->validate([
                'size' => ['required', 'in:' . implode(',', self::SHOE_SIZES)],
                'quantity' => 'required|integer|min:1|max:99',
            ]);

            if (! $checkoutProduct || $validated['quantity'] > $checkoutProduct->stock) {
                return redirect('/purchase/' . ($checkoutProductIds[0] ?? ''))
                    ->withErrors(['quantity' => 'Quantity cannot be greater than available stock.'])
                    ->withInput();
            }

            $request->session()->put('selected_size', $validated['size']);
            $request->session()->put('selected_quantity', $validated['quantity']);

            if (! empty($checkoutProductIds)) {
                $request->session()->put('selected_sizes', [
                    $checkoutProductIds[0] => $validated['size'],
                ]);

                $request->session()->put('selected_quantities', [
                    $checkoutProductIds[0] => $validated['quantity'],
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
        $selectedQuantity = (int) $request->session()->get('selected_quantity', 1);
        $selectedQuantities = $request->session()->get('selected_quantities', []);

        if ($isDirectPurchase && ! in_array($selectedSize, self::SHOE_SIZES, true)) {
            return redirect('/purchase/' . $ids[0])
                ->withErrors(['size' => 'Please choose a shoe size before purchasing.']);
        }

        if ($isDirectPurchase) {
            $directProduct = $products->firstWhere('id', $ids[0] ?? null);

            if ($selectedQuantity < 1 || $selectedQuantity > 99) {
                return redirect('/purchase/' . $ids[0])
                    ->withErrors(['quantity' => 'Please enter a valid quantity.']);
            }

            if ($directProduct && $selectedQuantity > $directProduct->stock) {
                return redirect('/purchase/' . $ids[0])
                    ->withErrors(['quantity' => 'Quantity cannot be greater than available stock.']);
            }
        }

        $total = $products->sum(fn ($product) => (float) $product->price * (int) ($selectedQuantities[$product->id] ?? 1));
        $checkoutDetails = $request->session()->get('checkout_details');
        $canEdit = $request->boolean('edit') || empty($checkoutDetails);

        return view('cod', compact('products', 'total', 'checkoutDetails', 'canEdit', 'selectedSize', 'selectedSizes', 'selectedQuantity', 'selectedQuantities'));
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
        $selectedQuantity = (int) $request->session()->get('selected_quantity', 1);
        $selectedQuantities = $request->session()->get('selected_quantities', []);

        if ($isDirectPurchase && ! in_array($selectedSize, self::SHOE_SIZES, true)) {
            return redirect('/purchase/' . $ids[0])
                ->withErrors(['size' => 'Please choose a shoe size before purchasing.']);
        }

        if ($isDirectPurchase && ($selectedQuantity < 1 || $selectedQuantity > 99)) {
            return redirect('/purchase/' . $ids[0])
                ->withErrors(['quantity' => 'Please enter a valid quantity.']);
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

        $purchase = DB::transaction(function () use ($ids, $details, $selectedSize, $selectedSizes, $selectedQuantities, $isDirectPurchase) {
            $products = Product::whereIn('id', $ids)
                ->where('stock', '>', 0)
                ->lockForUpdate()
                ->get();

            if ($products->isEmpty()) {
                throw new \Illuminate\Http\Exceptions\HttpResponseException(
                    redirect('/products')->with('status', 'Selected products are out of stock.')
                );
            }

            $totalPrice = 0;

            foreach ($products as $product) {
                $quantity = (int) ($selectedQuantities[$product->id] ?? 1);

                if ($quantity < 1 || $quantity > 99) {
                    throw new \Illuminate\Http\Exceptions\HttpResponseException(
                        redirect($isDirectPurchase ? '/purchase/' . $product->id : '/cart')
                            ->withErrors(['quantity' => 'Please enter a valid quantity.'])
                    );
                }

                if ($quantity > $product->stock) {
                    throw new \Illuminate\Http\Exceptions\HttpResponseException(
                        redirect($isDirectPurchase ? '/purchase/' . $product->id : '/cart')
                            ->withErrors(['quantity' => 'Quantity cannot be greater than available stock.'])
                    );
                }

                $totalPrice += (float) $product->price * $quantity;
            }

            $purchase = Purchase::create([
                ...$details,
                'total_price' => $totalPrice,
                'payment_method' => 'Cash on Delivery',
            ]);

            foreach ($products as $product) {
                $quantity = (int) ($selectedQuantities[$product->id] ?? 1);
                $subtotal = (float) $product->price * $quantity;

                $purchase->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'unit_price' => $product->price,
                    'quantity' => $quantity,
                    'size' => $selectedSizes[$product->id] ?? $selectedSize,
                    'subtotal' => $subtotal,
                ]);

                $product->decrement('stock', $quantity);
            }

            return $purchase;
        });

        $request->session()->put('checkout_details', $details);
        $request->session()->forget(['checkout_product_ids', 'checkout_source', 'cart', 'cart_quantities', 'selected_size', 'selected_sizes', 'selected_quantity', 'selected_quantities']);

       $productNames = $products->pluck('name')->implode(', ');

return redirect('/checkout')->with(
    'status',
    "Successfully purchased: {$productNames}"
);
    }
}
