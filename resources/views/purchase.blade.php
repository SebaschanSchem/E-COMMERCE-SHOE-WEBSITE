<x-layout title="Purchase | E-COMMERCE-SHOE-WEBSITE">

<div class="min-h-screen bg-white text-black">

@php
    $image = str_starts_with($product->image, 'http') ? $product->image : asset($product->image);
@endphp

<div class="min-h-screen bg-white text-black p-8 max-w-6xl mx-auto">

@if(session('status'))
    <div 
        id="toast-notification"
        class="fixed top-1/2 left-1/2 z-50
               -translate-x-1/2 -translate-y-1/2
               w-[340px] max-w-[90%]
               rounded-xl bg-green-500 text-white font-bold
               px-5 py-4 text-sm text-center
               shadow-2xl
               opacity-0 scale-95
               transition-all duration-500 ease-in-out">

         {{ session('status') }}
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toast = document.getElementById("toast-notification");

            setTimeout(() => {
                toast.classList.remove("opacity-0", "scale-95");
                toast.classList.add("opacity-100", "scale-100");
            }, 100);

            setTimeout(() => {
                toast.classList.remove("opacity-100", "scale-100");
                toast.classList.add("opacity-0", "scale-95");

                setTimeout(() => toast.remove(), 500);
            }, 2000);
        });
    </script>
@endif

    <!-- TOP SECTION -->
    <div class="grid md:grid-cols-2 gap-8">

        <!-- PRODUCT IMAGE -->
        <div class="bg-white border border-gray-200 h-[360px] flex items-center justify-center p-4 rounded-lg">
            <img src="{{ $image }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain">
        </div>

        <!-- PRODUCT INFO -->
        <div class="flex flex-col gap-4">

            <div class="flex justify-between items-start gap-4">

                <h1 class="text-2xl font-semibold leading-tight text-black">
                    {{ $product->name }}<br>
                    <span class="font-normal text-gray-500 text-sm capitalize">
                        {{ $product->category }}
                    </span>
                </h1>

                <form method="POST" action="/cart/{{ $product->id }}">
                    @csrf
                    <button type="submit"
                        class="border border-gray-300 rounded-full w-10 h-10 flex items-center justify-center hover:bg-black hover:text-white transition text-black"
                        title="Add to cart">
                        ♥
                    </button>
                </form>

            </div>

            <div class="text-2xl font-bold text-black">
                ₱{{ number_format($product->price, 2) }}
            </div>

            <div class="text-sm text-gray-500">
                Stock available: {{ $product->stock }}
            </div>

            <form method="GET" action="/checkout" id="purchaseForm">

    <!-- DROPDOWNS -->
    <div class="grid grid-cols-2 gap-4 text-sm">

        <div>
            <label class="block mb-1 text-gray-600">SIZE</label>

            <select 
                name="size"
                class="w-full bg-white border border-gray-300 p-2 rounded text-black"
                required>

                <option value="" disabled {{ old('size') ? '' : 'selected' }}>Choose size</option>
                @foreach (['41', '42', '43', '44'] as $size)
                    <option value="{{ $size }}" {{ old('size') === $size ? 'selected' : '' }}>{{ $size }}</option>
                @endforeach
            </select>
            @error('size')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1 text-gray-600">PAYMENT</label>
            <div class="w-full bg-white border border-gray-300 p-2 rounded text-black">
                <h1>Cash on Delivery (COD)</h1>
            </div>
        </div>

    </div>
            </form>

            <!-- DESCRIPTION -->
            <div class="border border-gray-200 rounded p-4 text-sm bg-white">

                <div class="font-semibold mb-2 text-black">
                    {{ $product->name }}
                </div>

                <p class="text-gray-600 text-xs leading-relaxed">
                    These shoes are selected for comfort, style, and everyday wear. The uploaded product image is displayed directly from the saved product record.
                </p>

                <div class="mt-4 grid sm:grid-cols-2 gap-3">

                    <form method="POST" action="/cart/{{ $product->id }}">
                        @csrf
                        <button type="submit"
                            class="w-full bg-black text-white py-2 rounded text-xs font-bold hover:bg-gray-800">
                            ADD TO CART
                        </button>
                    </form>

                    <button type="submit"
                form="purchaseForm"
                class="w-full bg-white border border-black text-black py-2 rounded text-xs font-bold text-center hover:bg-gray-400">
                PURCHASE
            </button>

                </div>

            </div>
        </div>
    </div>

    <!-- REVIEWS -->
    <div class="mt-16">

        <h2 class="text-sm mb-4 text-black">Latest reviews</h2>

        <div class="grid md:grid-cols-3 gap-6">

            @for ($i = 0; $i < 3; $i++)
                <div class="border border-gray-200 rounded p-4 text-xs bg-white">

                    <div class="mb-2 text-gray-500">★★★★★</div>

                    <div class="font-semibold text-sm mb-1 text-black">
                        {{ $product->name }}
                    </div>

                    <div class="text-gray-600 mb-2">
                        GOOD QUALITY!!
                    </div>

                    <div class="text-gray-400 text-[10px]">
                        5/6/26
                    </div>

                </div>
            @endfor

        </div>
    </div>

</div>

</div>

</x-layout>
