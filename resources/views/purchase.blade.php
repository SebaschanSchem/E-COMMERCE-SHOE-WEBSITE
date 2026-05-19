<x-layout title="Purchase | E-COMMERCE-SHOE-WEBSITE">

<div class="min-h-screen bg-[#050505] text-white">

@php
    $image = str_starts_with($product->image, 'http') ? $product->image : asset($product->image);
@endphp

<div class="min-h-screen p-6 md:p-8 max-w-6xl mx-auto">

@if(session('status'))
    <div
        id="toast-notification"
        class="fixed top-1/2 left-1/2 z-50
               -translate-x-1/2 -translate-y-1/2
               w-[340px] max-w-[90%]
               rounded-2xl border border-green-300/30 bg-green-500 text-white font-bold
               px-5 py-4 text-sm text-center
               shadow-2xl shadow-green-500/20
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
    <div class="grid md:grid-cols-2 gap-8 items-start">

        <!-- PRODUCT IMAGE -->
        <div class="relative h-[360px] md:h-[460px] flex items-center justify-center overflow-hidden rounded-[2rem] border border-white/10 bg-gradient-to-br from-white via-zinc-100 to-zinc-300 p-6 shadow-[0_40px_120px_rgba(0,0,0,0.55)]">
            <div class="absolute inset-x-12 bottom-10 h-16 rounded-full bg-black/20 blur-2xl"></div>
            <img src="{{ $image }}" alt="{{ $product->name }}" class="relative max-h-full max-w-full object-contain drop-shadow-2xl">
        </div>

        <!-- PRODUCT INFO -->
        <div class="flex flex-col gap-5">

            <div class="flex justify-between items-start gap-4">

                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.35em] text-lime-300">Product Detail</p>
                <h1 class="mt-2 text-3xl font-black uppercase leading-tight tracking-tight text-white md:text-5xl">
                    {{ $product->name }}<br>
                    <span class="text-sm font-bold uppercase tracking-[0.25em] text-white/40">
                        {{ $product->category }}
                    </span>
                </h1>
                </div>

                <form method="POST" action="/cart/{{ $product->id }}">
                    @csrf
                    <input type="hidden" name="quantity" class="cart-quantity-input" value="{{ old('quantity', 1) }}">
                    <button type="submit"
                        class="border border-white/10 rounded-full w-12 h-12 flex items-center justify-center bg-white/[0.04] text-white/80 transition duration-300 hover:border-pink-300 hover:bg-pink-500 hover:text-white"
                        title="Add to cart">
                        &#9829;
                    </button>
                </form>

            </div>

            <div class="text-3xl font-black text-lime-300">
                Php {{ number_format($product->price, 2) }}
            </div>

            <div class="text-sm text-white/50">
                Stock available: {{ $product->stock }}
            </div>

            <form method="GET" action="/checkout" id="purchaseForm">

    <!-- DROPDOWNS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">

    <!-- SIZE -->
    <div>
        <label class="block mb-1 text-xs font-bold uppercase tracking-[0.22em] text-white/50">
            SIZE
        </label>

        <select
            name="size"
            class="w-full rounded-xl border border-white/10 bg-white/[0.06] p-3 text-white focus:outline-none focus:border-lime-300/70"
            required>

            <option value="" disabled {{ old('size') ? '' : 'selected' }}>
                Choose size
            </option>

            @foreach (['41', '42', '43', '44'] as $size)
                <option value="{{ $size }}"
                    {{ old('size') === $size ? 'selected' : '' }}>
                    {{ $size }}
                </option>
            @endforeach
        </select>

        @error('size')
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- QUANTITY -->
    <div>
        <label class="block mb-1 text-xs font-bold uppercase tracking-[0.22em] text-white/50">
            QUANTITY
        </label>

        <input
            id="purchaseQuantity"
            type="number"
            name="quantity"
            min="1"
            max="{{ min(99, $product->stock) }}"
            value="{{ old('quantity', 1) }}"
            class="w-full rounded-xl border border-white/10 bg-white/[0.06] p-3 text-white focus:outline-none focus:border-lime-300/70"
            required>

        @error('quantity')
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- PAYMENT -->
    <div>
        <label class="block mb-1 text-xs font-bold uppercase tracking-[0.22em] text-white/50">
            PAYMENT
        </label>

        <div class="w-full rounded-xl border border-white/10 bg-white/[0.06] p-3 text-white">
            Cash on Delivery (COD)
        </div>
    </div>

</div>
            </form>

            <!-- DESCRIPTION -->
            <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-5 text-sm shadow-2xl shadow-black/25">

                <div class="font-black uppercase tracking-wide mb-2 text-white">
                    {{ $product->name }}
                </div>

                <p class="text-white/55 text-xs leading-7">
                    These shoes are selected for comfort, style, and everyday wear. The uploaded product image is displayed directly from the saved product record.
                </p>

                <div class="mt-5 grid sm:grid-cols-2 gap-3">

                    <form method="POST" action="/cart/{{ $product->id }}">
                        @csrf
                        <input type="hidden" name="quantity" class="cart-quantity-input" value="{{ old('quantity', 1) }}">
                        <button type="submit"
                            class="w-full rounded-full bg-white py-3 text-xs font-black uppercase tracking-[0.2em] text-black transition duration-300 hover:bg-lime-300">
                            ADD TO CART
                        </button>
                    </form>

                    <button type="submit"
                form="purchaseForm"
                class="w-full rounded-full border border-white/15 bg-white/[0.04] py-3 text-xs font-black uppercase tracking-[0.2em] text-white transition duration-300 hover:border-lime-300/70 hover:bg-lime-300 hover:text-black">
                PURCHASE
            </button>

                </div>

            </div>
        </div>
    </div>

    <!-- REVIEWS -->
    <div class="mt-16">

        <h2 class="text-sm font-black uppercase tracking-[0.25em] mb-4 text-white">Latest reviews</h2>

        <div class="grid md:grid-cols-3 gap-6">

            @for ($i = 0; $i < 3; $i++)
                <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-5 text-xs shadow-2xl shadow-black/20">

                    <div class="mb-2 text-lime-300">*****</div>

                    <div class="font-black text-sm mb-1 text-white">
                        {{ $product->name }}
                    </div>

                    <div class="text-white/55 mb-2">
                        GOOD QUALITY!!
                    </div>

                    <div class="text-white/30 text-[10px]">
                        5/6/26
                    </div>

                </div>
            @endfor

        </div>
    </div>

</div>

</div>

<script>
    const purchaseQuantity = document.getElementById('purchaseQuantity');
    const cartQuantityInputs = [...document.querySelectorAll('.cart-quantity-input')];

    purchaseQuantity?.addEventListener('input', (event) => {
        cartQuantityInputs.forEach((input) => {
            input.value = event.target.value;
        });
    });
</script>

</x-layout>
