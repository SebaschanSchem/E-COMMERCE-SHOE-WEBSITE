<x-layout title="Checkout | E-COMMERCE-SHOE-WEBSITE">

<section class="bg-white py-14 px-6 text-white min-h-screen">
<div class="min-h-screen bg-white text-black p-6 max-w-6xl mx-auto">

    {{-- STATUS --}}
    @if (session('status'))
        <div class="mb-4 rounded-lg bg-gray-100 border border-gray-300 px-4 py-3 text-sm text-black">
            {{ session('status') }}
        </div>
    @endif

    {{-- DELIVERY ADDRESS --}}
    <div class="mb-6">

        <div class="flex items-center justify-between mb-3">
            <h2 class="text-lg font-semibold">Delivery Address</h2>

            @if ($checkoutDetails && ! $canEdit)
                <a href="/checkout?edit=1" class="border border-gray-300 px-3 py-1 text-xs rounded hover:bg-gray-100">
                    Edit
                </a>
            @endif
        </div>

        @if ($canEdit)

            <form method="POST" action="/checkout" id="checkoutForm"
                class="grid md:grid-cols-3 gap-3 border border-gray-200 rounded-lg p-4 bg-white">

                @csrf

                @if ($checkoutDetails)
                    <input type="hidden" name="allow_update" value="1">
                @endif

                <div>
                    <label class="block text-xs text-gray-600 mb-1">Full Name</label>
                    <input type="text" name="full_name" required
                        value="{{ old('full_name', $checkoutDetails['full_name'] ?? '') }}"
                        class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm text-black">
                    @error('full_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1">Address</label>
                    <input type="text" name="address" required
                        value="{{ old('address', $checkoutDetails['address'] ?? '') }}"
                        class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm text-black"
                        required>
                    @error('address') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
    <label class="block text-xs text-gray-600 mb-1">Contact Number</label>

    <input type="tel"
        name="contact_number"
        required
        pattern="09[0-9]{9}"
        maxlength="11"
        inputmode="numeric"
        value="{{ old('contact_number', $checkoutDetails['contact_number'] ?? '') }}"
        class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm text-black"
    >

    <p class="text-[10px] text-gray-500 mt-1">
        Must start with 09 and contain 11 digits
    </p>

    @error('contact_number')
        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

            </form>

        @elseif ($checkoutDetails)

            <div class="flex justify-between text-xs border border-gray-200 rounded-lg p-4 bg-white">

                <div class="text-black">
                    {{ $checkoutDetails['full_name'] }}<br>
                    {{ $checkoutDetails['contact_number'] }}
                </div>

                <div class="text-right text-black max-w-xl">
                    {{ $checkoutDetails['address'] }}
                </div>

            </div>

        @endif
    </div>

    <hr class="border-gray-200 my-6">

    {{-- PRODUCTS --}}
    <div>

        <h2 class="text-lg font-semibold mb-4">Products Ordered</h2>

        <div class="grid grid-cols-5 text-xs text-gray-600 mb-3">
            <div class="col-span-2"></div>
            <div>Unit Price</div>
            <div>Quantity</div>
            <div>Subtotal</div>
        </div>

        @forelse ($products as $product)

            @php
                $image = str_starts_with($product->image, 'http') ? $product->image : asset($product->image);
            @endphp

            <div class="grid grid-cols-5 items-center gap-4 mb-6 bg-white border border-gray-200 rounded-lg p-3">

                <div class="col-span-2 flex gap-3 items-center">

                    <div class="bg-white border border-gray-200 w-20 h-20 flex items-center justify-center rounded overflow-hidden">
                        <img src="{{ $image }}" class="w-full h-full object-contain">
                    </div>

                    <div class="text-xs text-black">
                        <div class="font-semibold">{{ $product->name }}</div>
                        <div class="text-gray-500 capitalize">{{ $product->category }}</div>
                        <div class="text-gray-400 text-[10px]">SIZE: 42</div>
                    </div>

                </div>

                <div class="text-xs text-black">
                    ₱{{ number_format($product->price, 2) }}
                </div>

                <div class="text-xs text-center text-black">1</div>

                <div class="text-xs text-black">
                    ₱{{ number_format($product->price, 2) }}
                </div>

            </div>

        @empty

            <div class="bg-white border border-gray-200 rounded p-8 text-center text-black">
                No selected products yet.
            </div>

        @endforelse

    </div>

    <hr class="border-gray-200 my-6">

    {{-- SUMMARY --}}
    <div class="grid md:grid-cols-2 gap-6 text-xs">

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <div class="font-semibold mb-1 text-black">Payment Method</div>
            <div class="text-gray-600">Cash on Delivery (COD)</div>
        </div>

        <div class="text-right">
            <div class="text-gray-600 text-xs">
                Order Total ({{ $products->count() }} items):
            </div>
            <div class="text-2xl font-semibold text-black">
                ₱{{ number_format($total, 2) }}
            </div>
        </div>

    </div>

    {{-- BUTTON --}}
    <div class="flex justify-end mt-6">

        @if ($canEdit)
            <button form="checkoutForm" type="submit"
                @disabled($products->isEmpty())
                class="bg-black text-white px-8 py-3 rounded-lg font-bold hover:bg-gray-800 disabled:opacity-40">
                Place COD Order
            </button>
        @else
            <form method="POST" action="/checkout">
                @csrf
                <button type="submit"
                    @disabled($products->isEmpty())
                    class="bg-black text-white px-8 py-3 rounded-lg font-bold hover:bg-gray-800 disabled:opacity-40">
                    Place COD Order
                </button>
            </form>
        @endif

    </div>

</div>
</section>

</x-layout>