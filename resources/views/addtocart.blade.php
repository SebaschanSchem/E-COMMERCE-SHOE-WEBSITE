<x-layout title="Cart | E-COMMERCE-SHOE-WEBSITE">

<div class="min-h-screen bg-[#050505] text-white">

    <div class="border-b border-white/10 bg-black/60">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center gap-2">
            <span class="font-mono text-xs text-lime-300 uppercase tracking-[0.25em]">Cart</span>
            <span class="text-white/20">/</span>
            <span class="font-mono text-xs text-white/60 uppercase tracking-[0.25em]">Your Items</span>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- STATUS --}}
        @if (session('status'))
    <div
        id="toast-notification"
        class="fixed top-1/2 left-1/2 z-50
               -translate-x-1/2 -translate-y-1/2
               w-[340px] max-w-[90%]
               rounded-2xl border border-red-300/30 bg-red-500 text-white
               px-5 py-4 text-sm text-center
               shadow-2xl shadow-red-500/20
               opacity-0 scale-95
               transition-all duration-500 ease-in-out">

        {{ session('status') }}
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toast = document.getElementById("toast-notification");

            // show
            setTimeout(() => {
                toast.classList.remove("opacity-0", "scale-95");
                toast.classList.add("opacity-100", "scale-100");
            }, 100);

            // hide after 2 seconds
            setTimeout(() => {
                toast.classList.remove("opacity-100", "scale-100");
                toast.classList.add("opacity-0", "scale-95");

                setTimeout(() => {
                    toast.remove();
                }, 500);
            }, 2000);
        });
    </script>
@endif

        <div class="mb-8">
            <p class="text-xs font-bold uppercase tracking-[0.35em] text-lime-300">Checkout Queue</p>
            <h1 class="mt-2 text-3xl font-black uppercase tracking-tight md:text-5xl">Shopping Cart</h1>
        </div>

        @if($products->isEmpty())
            <div class="text-center py-20 border border-white/10 rounded-2xl bg-white/[0.04] shadow-2xl shadow-black/25">
                <p class="text-lg font-black uppercase tracking-wide">Your cart is empty</p>
                <p class="text-sm text-white/50 mt-2">Start adding your favorite shoes.</p>
            </div>
        @else

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT: ITEMS --}}
            <div class="lg:col-span-2 space-y-4">

                @foreach ($products as $product)
                    @php
                        $image = str_starts_with($product->image, 'http') ? $product->image : asset($product->image);
                        $quantity = (int) ($selectedQuantities[$product->id] ?? 1);
                        $subtotal = (float) $product->price * $quantity;
                    @endphp

                    <div class="flex flex-col gap-5 rounded-2xl border border-white/10 bg-white/[0.04] p-4 shadow-2xl shadow-black/25 transition duration-300 hover:-translate-y-1 hover:border-lime-300/40 sm:flex-row">

                        <div class="w-full h-40 sm:w-28 sm:h-28 bg-gradient-to-br from-white via-zinc-100 to-zinc-300 rounded-xl flex items-center justify-center overflow-hidden">
                            <img src="{{ $image }}" class="w-full h-full object-contain p-3">
                        </div>

                        <div class="flex-1 flex flex-col justify-between gap-5">

                            <div>
                                <h2 class="font-black text-sm uppercase tracking-[0.18em]">
                                    {{ $product->name }}
                                </h2>
                                <p class="text-xs text-white/40 capitalize">
                                    {{ $product->category }}
                                </p>
                            </div>

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                                <div>
                                    <p class="text-2xl font-black text-lime-300">
                                        Php {{ number_format($subtotal, 2) }}
                                    </p>
                                    <p class="text-xs text-white/40">
                                        Php {{ number_format($product->price, 2) }} each
                                    </p>
                                </div>

                                <div>
                                    <label class="text-xs text-white/40 uppercase tracking-[0.22em]">Size</label>
                                    <select
                                        name="sizes[{{ $product->id }}]"
                                        form="cartCheckoutForm"
                                        required
                                        class="block mt-1 rounded-lg border border-white/10 bg-black/60 px-3 py-2 text-sm text-white focus:outline-none focus:border-lime-300/70">
                                        <option value="" disabled {{ empty($selectedSizes[$product->id]) ? 'selected' : '' }}>Choose size</option>
                                        @foreach (['41', '42', '43', '44'] as $size)
                                            <option value="{{ $size }}" {{ ($selectedSizes[$product->id] ?? '') === $size ? 'selected' : '' }}>{{ $size }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="text-xs text-white/40 uppercase tracking-[0.22em]">Quantity</label>
                                    <input
                                        type="number"
                                        name="quantities[{{ $product->id }}]"
                                        form="cartCheckoutForm"
                                        min="1"
                                        max="{{ min(99, $product->stock) }}"
                                        value="{{ old('quantities.' . $product->id, $quantity) }}"
                                        required
                                        class="block mt-1 w-24 rounded-lg border border-white/10 bg-black/60 px-3 py-2 text-sm text-white focus:outline-none focus:border-lime-300/70">
                                </div>

                            </div>
                        </div>

                        <form method="POST" action="/cart/{{ $product->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 text-white/60 transition hover:border-red-400 hover:bg-red-500 hover:text-white">
                                x
                            </button>
                        </form>

                    </div>
                @endforeach

            </div>

            {{-- RIGHT: SUMMARY --}}
            <div class="lg:col-span-1">
                <div class="border border-white/10 rounded-2xl p-6 sticky top-24 bg-white/[0.04] shadow-2xl shadow-black/30 backdrop-blur">

                    <h3 class="text-sm font-black uppercase tracking-[0.25em] mb-5">Order Summary</h3>

                    <div class="flex justify-between text-sm mb-3 text-white/60">
                        <span>Items</span>
                        <span class="text-white">{{ $products->sum(fn($p) => (int) ($selectedQuantities[$p->id] ?? 1)) }}</span>
                    </div>

                    <div class="flex justify-between text-sm mb-6 text-white/60">
                        <span>Total</span>
                        <span class="font-black text-lime-300">
                            Php {{ number_format($products->sum(fn($p) => (float) $p->price * (int) ($selectedQuantities[$p->id] ?? 1)), 2) }}
                        </span>
                    </div>

                    @error('sizes')
                        <p class="text-xs text-red-400 mb-3 text-center">{{ $message }}</p>
                    @enderror
                    @error('quantities')
                        <p class="text-xs text-red-400 mb-3 text-center">{{ $message }}</p>
                    @enderror
                    @error('quantity')
                        <p class="text-xs text-red-400 mb-3 text-center">{{ $message }}</p>
                    @enderror

                    <form method="POST" action="/cart/purchase-all" id="cartCheckoutForm">
                        @csrf
                        <button
                            @disabled($products->isEmpty())
                            class="w-full rounded-full bg-white py-3 text-sm font-black uppercase tracking-[0.22em] text-black transition duration-300 hover:bg-lime-300 disabled:opacity-40">
                            Checkout
                        </button>
                    </form>

                    <p class="text-xs text-white/40 mt-4 text-center">
                        Secure checkout powered by your system
                    </p>

                </div>
            </div>

        </div>

        @endif

    </div>

</div>

</x-layout>
