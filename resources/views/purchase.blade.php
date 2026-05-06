<x-layout title="Purchase | E-COMMERCE-SHOE-WEBSITE">

@php
    $image = str_starts_with($product->image, 'http') ? $product->image : asset($product->image);
@endphp

<div class="p-8 max-w-6xl mx-auto">
    <!-- Top Section -->
    <div class="grid md:grid-cols-2 gap-8">
        <!-- Product Image -->
        <div class="bg-gray-200 h-[360px] flex items-center justify-center p-4 rounded-lg">
            <img src="{{ $image }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain">
        </div>

        <!-- Product Info -->
        <div class="flex flex-col gap-4">
            <div class="flex justify-between items-start gap-4">
                <h1 class="text-2xl font-semibold leading-tight">
                    {{ $product->name }}<br>
                    <span class="font-normal text-gray-300 text-sm capitalize">{{ $product->category }}</span>
                </h1>

                <form method="POST" action="/cart/{{ $product->id }}">
                    @csrf
                    <button type="submit" class="border rounded-full w-10 h-10 flex items-center justify-center hover:bg-white hover:text-black text-pink-200" title="Add to cart">
                        &#9829;
                    </button>
                </form>
            </div>

            <div class="text-2xl font-bold">Php {{ number_format($product->price, 2) }}</div>
            <div class="text-sm text-gray-400">Stock available: {{ $product->stock }}</div>

            <!-- Dropdowns -->
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <label class="block mb-1 text-gray-400">SIZE</label>
                    <select class="w-full bg-[#2a2a2a] border border-gray-600 p-2 rounded">
                        <option>41-42</option>
                        <option>42-43</option>
                        <option>43-44</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-gray-400">PAYMENT</label>
                    <select class="w-full bg-[#2a2a2a] border border-gray-600 p-2 rounded">
                        <option>COD</option>
                    </select>
                </div>
            </div>

            <!-- Description -->
            <div class="border border-gray-700 rounded p-4 text-sm">
                <div class="font-semibold mb-2">{{ $product->name }}</div>
                <p class="text-gray-400 text-xs leading-relaxed">
                    These shoes are selected for comfort, style, and everyday wear. The uploaded product image is displayed directly from the saved product record.
                </p>

                <div class="mt-4 grid sm:grid-cols-2 gap-3">
                    <form method="POST" action="/cart/{{ $product->id }}">
                        @csrf
                        <button type="submit" class="w-full bg-gray-300 text-black py-2 rounded text-xs font-bold">
                            ADD TO CART
                        </button>
                    </form>

                    <a href="/checkout" class="w-full bg-white text-black py-2 rounded text-xs font-bold text-center">
                        PURCHASE
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="mt-16">
        <h2 class="text-sm mb-4">Latest reviews</h2>

        <div class="grid md:grid-cols-3 gap-6">
            @for ($i = 0; $i < 3; $i++)
            <div class="border border-gray-700 rounded p-4 text-xs">
                <div class="mb-2 text-gray-400">*****</div>
                <div class="font-semibold text-sm mb-1">{{ $product->name }}</div>
                <div class="text-gray-400 mb-2">GOOD QUALITY!!</div>
                <div class="text-gray-500 text-[10px]">5/6/26</div>
            </div>
            @endfor
        </div>
    </div>
</div>

</x-layout>
