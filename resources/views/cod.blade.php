<x-layout title="Checkout | E-COMMERCE-SHOE-WEBSITE">

<div class="relative z-10 p-6 max-w-6xl mx-auto">
    @if (session('status'))
        <div class="mb-4 rounded-lg bg-green-500/20 border border-green-300/30 px-4 py-3 text-sm">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-6">
        <div class="flex items-center justify-between gap-4 mb-3">
            <h2 class="text-lg font-semibold">Delivery Address</h2>
            @if ($checkoutDetails && ! $canEdit)
                <a href="/checkout?edit=1" class="bg-gray-700 px-3 py-1 text-xs rounded hover:bg-gray-600">Edit</a>
            @endif
        </div>

        @if ($canEdit)
            <form method="POST" action="/checkout" id="checkoutForm" class="grid md:grid-cols-3 gap-3 bg-[#181818] border border-gray-800 rounded-lg p-4">
                @csrf
                @if ($checkoutDetails)
                    <input type="hidden" name="allow_update" value="1">
                @endif

                <div>
                    <label class="block text-xs text-gray-400 mb-1">Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $checkoutDetails['full_name'] ?? '') }}" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-sm" required>
                    @error('full_name') <p class="text-xs text-red-300 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs text-gray-400 mb-1">Address</label>
                    <input type="text" name="address" value="{{ old('address', $checkoutDetails['address'] ?? '') }}" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-sm" required>
                    @error('address') <p class="text-xs text-red-300 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs text-gray-400 mb-1">Contact Number</label>
                    <input type="text" name="contact_number" value="{{ old('contact_number', $checkoutDetails['contact_number'] ?? '') }}" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-sm" required>
                    @error('contact_number') <p class="text-xs text-red-300 mt-1">{{ $message }}</p> @enderror
                </div>
            </form>
        @elseif ($checkoutDetails)
            <div class="flex justify-between text-xs text-gray-300 bg-[#181818] border border-gray-800 rounded-lg p-4">
                <div>
                    {{ $checkoutDetails['full_name'] }}<br>
                    {{ $checkoutDetails['contact_number'] }}
                </div>

                <div class="text-right max-w-xl">
                    {{ $checkoutDetails['address'] }}
                </div>
            </div>
        @endif
    </div>

    <hr class="border-gray-700 my-6">

    <div>
        <h2 class="text-lg italic mb-4">Products Ordered</h2>

        <div class="grid grid-cols-5 text-xs text-gray-400 mb-3">
            <div class="col-span-2"></div>
            <div>Unit Price</div>
            <div>Quantity Item</div>
            <div>Subtotal</div>
        </div>

        @forelse ($products as $product)
            @php
                $image = str_starts_with($product->image, 'http') ? $product->image : asset($product->image);
            @endphp

            <div class="grid grid-cols-5 items-center gap-4 mb-6">
                <div class="col-span-2 flex gap-3 items-center">
                    <div class="bg-gray-200 w-20 h-20 flex items-center justify-center rounded overflow-hidden">
                        <img src="{{ $image }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                    </div>

                    <div class="text-xs">
                        <div class="font-semibold">{{ $product->name }}</div>
                        <div class="text-gray-400 capitalize">{{ $product->category }}</div>
                        <div class="text-gray-500 text-[10px]">SIZE: 42</div>
                    </div>
                </div>

                <div class="text-xs">Php {{ number_format($product->price, 2) }}</div>
                <div class="text-xs text-center">1</div>
                <div class="text-xs">Php {{ number_format($product->price, 2) }}</div>
            </div>
        @empty
            <div class="bg-[#181818] border border-gray-800 rounded p-8 text-center text-gray-300">
                No selected products yet.
            </div>
        @endforelse
    </div>

    <hr class="border-gray-700 my-6">

    <div class="grid md:grid-cols-2 gap-6 text-xs">
        <div class="bg-[#181818] border border-gray-800 rounded-lg p-4">
            <div class="font-semibold mb-1">Payment Method</div>
            <div class="text-gray-300">Cash on Delivery (COD)</div>
        </div>

        <div class="text-right">
            <div class="text-gray-400 text-xs">Order Total ({{ $products->count() }} items):</div>
            <div class="ml-2 text-2xl font-semibold">Php {{ number_format($total, 2) }}</div>
        </div>
    </div>

    <div class="flex justify-end mt-6">
        @if ($canEdit)
            <button form="checkoutForm" type="submit" @disabled($products->isEmpty()) class="bg-white text-black px-8 py-3 rounded-lg font-bold hover:bg-gray-200 disabled:opacity-40">
                Place COD Order
            </button>
        @else
            <form method="POST" action="/checkout">
                @csrf
                <button type="submit" @disabled($products->isEmpty()) class="bg-white text-black px-8 py-3 rounded-lg font-bold hover:bg-gray-200 disabled:opacity-40">
                    Place COD Order
                </button>
            </form>
        @endif
    </div>
</div>

</x-layout>
