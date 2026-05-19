<x-layout title="Checkout | E-COMMERCE-SHOE-WEBSITE">

<section class="min-h-screen bg-[#050505] py-12 px-6 text-white">
<div class="min-h-screen max-w-6xl mx-auto">

    {{-- STATUS --}}
@if (session('status'))
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
        <p class="text-xs font-bold uppercase tracking-[0.35em] text-lime-300">Final Step</p>
        <h1 class="mt-2 text-3xl font-black uppercase tracking-tight md:text-5xl">Checkout</h1>
    </div>

    {{-- DELIVERY ADDRESS --}}
    <div class="mb-6">

        <div class="flex items-center justify-between mb-3">
            <h2 class="text-lg font-black uppercase tracking-wide">Delivery Address</h2>

            @if ($checkoutDetails && ! $canEdit)
                <a href="/checkout?edit=1" class="rounded-full border border-white/15 px-4 py-2 text-xs font-bold uppercase tracking-[0.18em] text-white/70 transition hover:border-white/35 hover:bg-white/10 hover:text-white">
                    Edit
                </a>
            @endif
        </div>

        @if ($canEdit)

            <form method="POST" action="/checkout" id="checkoutForm"
                class="grid md:grid-cols-3 gap-3 rounded-2xl border border-white/10 bg-white/[0.04] p-4 shadow-2xl shadow-black/25">

                @csrf

                @if ($checkoutDetails)
                    <input type="hidden" name="allow_update" value="1">
                @endif

                <div>
                    <label class="block text-xs text-white/50 mb-1 uppercase tracking-[0.2em]">Full Name</label>
                    <input type="text" name="full_name" required
                        value="{{ old('full_name', $checkoutDetails['full_name'] ?? '') }}"
                        class="w-full rounded-xl border border-white/10 bg-black/50 px-3 py-3 text-sm text-white focus:outline-none focus:border-lime-300/70">
                    @error('full_name') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs text-white/50 mb-1 uppercase tracking-[0.2em]">Address</label>
                    <input type="text" name="address" required
                        value="{{ old('address', $checkoutDetails['address'] ?? '') }}"
                        class="w-full rounded-xl border border-white/10 bg-black/50 px-3 py-3 text-sm text-white focus:outline-none focus:border-lime-300/70"
                        required>
                    @error('address') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
    <label class="block text-xs text-white/50 mb-1 uppercase tracking-[0.2em]">Contact Number</label>

    <input type="tel"
        name="contact_number"
        required
        pattern="09[0-9]{9}"
        maxlength="11"
        inputmode="numeric"
        value="{{ old('contact_number', $checkoutDetails['contact_number'] ?? '') }}"
        class="w-full rounded-xl border border-white/10 bg-black/50 px-3 py-3 text-sm text-white focus:outline-none focus:border-lime-300/70"
    >

    <p class="text-[10px] text-white/40 mt-1">
        Must start with 09 and contain 11 digits
    </p>

    @error('contact_number')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
    @enderror
</div>

            </form>

        @elseif ($checkoutDetails)

            <div class="flex flex-col gap-4 rounded-2xl border border-white/10 bg-white/[0.04] p-5 text-xs shadow-2xl shadow-black/25 md:flex-row md:justify-between">

                <div class="text-white">
                    {{ $checkoutDetails['full_name'] }}<br>
                    {{ $checkoutDetails['contact_number'] }}
                </div>

                <div class="text-left text-white/70 max-w-xl md:text-right">
                    {{ $checkoutDetails['address'] }}
                </div>

            </div>

        @endif
    </div>

    <hr class="border-white/10 my-8">

    {{-- PRODUCTS --}}
    <div>

        <h2 class="text-lg font-black uppercase tracking-wide mb-4">Products Ordered</h2>

        <div class="hidden grid-cols-5 text-xs text-white/40 mb-3 md:grid">
            <div class="col-span-2"></div>
            <div>Unit Price</div>
            <div>Quantity</div>
            <div>Subtotal</div>
        </div>

        @forelse ($products as $product)

            @php
                $image = str_starts_with($product->image, 'http') ? $product->image : asset($product->image);
                $quantity = (int) ($selectedQuantities[$product->id] ?? 1);
                $subtotal = (float) $product->price * $quantity;
            @endphp

            <div class="grid gap-4 mb-4 rounded-2xl border border-white/10 bg-white/[0.04] p-4 shadow-2xl shadow-black/20 md:grid-cols-5 md:items-center">

                <div class="md:col-span-2 flex gap-3 items-center">

                    <div class="bg-gradient-to-br from-white via-zinc-100 to-zinc-300 w-20 h-20 flex items-center justify-center rounded-xl overflow-hidden">
                        <img src="{{ $image }}" class="w-full h-full object-contain p-2">
                    </div>

                    <div class="text-xs text-white">
                        <div class="font-black uppercase tracking-wide">{{ $product->name }}</div>
                        <div class="text-white/40 capitalize">{{ $product->category }}</div>
                        @if (! empty($selectedSizes[$product->id] ?? $selectedSize))
                            <div class="text-lime-300 text-[10px] uppercase tracking-[0.2em]">SIZE: {{ $selectedSizes[$product->id] ?? $selectedSize }}</div>
                        @endif
                    </div>

                </div>

                <div class="text-xs text-white">
                    Php {{ number_format($product->price, 2) }}
                </div>

                <div class="text-xs text-white md:text-center">{{ $quantity }}</div>

                <div class="text-xs font-bold text-lime-300">
                    Php {{ number_format($subtotal, 2) }}
                </div>

            </div>

        @empty

            <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-8 text-center text-white/50">
                No selected products yet.
            </div>

        @endforelse

    </div>

    <hr class="border-white/10 my-8">

    {{-- SUMMARY --}}
    <div class="grid md:grid-cols-2 gap-6 text-xs">

        <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-5 shadow-2xl shadow-black/20">
            <div class="font-black uppercase tracking-wide mb-1 text-white">Payment Method</div>
            <div class="text-white/60">Cash on Delivery (COD)</div>
        </div>

        <div class="text-right">
            <div class="text-white/50 text-xs">
                Order Total ({{ collect($selectedQuantities)->sum() ?: $products->count() }} items):
            </div>
            <div class="text-3xl font-black text-lime-300">
                Php {{ number_format($total, 2) }}
            </div>
        </div>

    </div>

    {{-- BUTTON --}}
    <div class="flex justify-end mt-6">

        @if ($canEdit)
            <button form="checkoutForm" type="submit"
                @disabled($products->isEmpty())
                class="rounded-full bg-white px-8 py-3 font-black uppercase tracking-[0.18em] text-black transition duration-300 hover:bg-lime-300 disabled:opacity-40">
                Place COD Order
            </button>
        @else
            <form method="POST" action="/checkout">
                @csrf
                <button type="submit"
                    @disabled($products->isEmpty())
                    class="rounded-full bg-white px-8 py-3 font-black uppercase tracking-[0.18em] text-black transition duration-300 hover:bg-lime-300 disabled:opacity-40">
                    Place COD Order
                </button>
            </form>
        @endif

    </div>

</div>
</section>

</x-layout>
