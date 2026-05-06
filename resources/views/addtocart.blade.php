<x-layout title="Cart | E-COMMERCE-SHOE-WEBSITE">

<div class="bg-darker border-b border-border">
    <div class="max-w-4xl mx-auto px-6 py-2 flex items-center gap-2">
        <span class="font-mono text-xs text-muted uppercase tracking-widest">Cart</span>
        <span class="text-border">/</span>
        <span class="font-mono text-xs text-gold uppercase tracking-widest">Your Items</span>
    </div>
</div>

<div class="max-w-4xl mx-auto px-6 py-10">
    @if (session('status'))
        <div class="mb-4 rounded-lg bg-green-500/20 border border-green-300/30 px-4 py-3 text-sm">
            {{ session('status') }}
        </div>
    @endif

    <div class="space-y-3" id="cart-items">
        @forelse ($products as $product)
            @php
                $image = str_starts_with($product->image, 'http') ? $product->image : asset($product->image);
            @endphp

            <div class="cart-item group relative flex items-start gap-5 bg-[#181818] rounded-sm p-4 border border-gray-800 hover:border-white/30">
                <div class="shrink-0 w-28 h-24 bg-[#2c2c2c] rounded-sm overflow-hidden flex items-center justify-center border border-gray-700">
                    <img src="{{ $image }}" alt="{{ $product->name }}" class="w-full h-full object-contain object-center">
                </div>

                <div class="flex-1 min-w-0">
                    <p class="font-body text-xs text-gray-300 uppercase tracking-widest mb-0.5">{{ $product->name }}</p>
                    <p class="font-body text-xs text-gray-500 mb-3 capitalize">{{ $product->category }}</p>

                    <div class="flex items-end justify-between gap-4 flex-wrap">
                        <div>
                            <p class="font-display text-3xl tracking-wider text-white leading-none">Php {{ number_format($product->price, 2) }}</p>
                        </div>
                        <div>
                            <label class="block font-mono text-xs text-gray-400 uppercase tracking-widest mb-1">Size</label>
                            <select class="bg-black border border-gray-700 text-white text-xs font-body px-3 py-1.5 focus:outline-none focus:border-white transition-colors min-w-[90px]">
                                <option>41-42</option>
                                <option>43-44</option>
                                <option>45-46</option>
                            </select>
                        </div>
                    </div>
                </div>

                <form method="POST" action="/cart/{{ $product->id }}" class="absolute top-4 right-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-pink-300 hover:text-white" aria-label="Remove from cart">
                        &#9829;
                    </button>
                </form>
            </div>
        @empty
            <div class="bg-[#181818] border border-gray-800 rounded p-8 text-center text-gray-300">
                Your cart is empty. Heart a product to add it here.
            </div>
        @endforelse
    </div>

    <div class="mt-8 pt-6 border-t border-gray-800 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
        <div class="space-y-1">
            <div class="flex items-center gap-4">
                <span class="font-body text-xs text-gray-400 uppercase tracking-widest">Items ({{ $products->count() }})</span>
                <span class="font-mono text-xs text-gray-500">/</span>
                <span class="font-body text-xs text-gray-400">Free shipping on orders over Php 2,000</span>
            </div>
            <div class="flex items-baseline gap-3">
                <span class="font-body text-sm text-gray-400">Total</span>
                <span class="font-display text-4xl tracking-wider text-white">Php {{ number_format($products->sum(fn ($product) => (float) $product->price), 2) }}</span>
            </div>
        </div>

        <form method="POST" action="/cart/purchase-all" class="w-full sm:w-auto">
            @csrf
            <button type="submit"
                @disabled($products->isEmpty())
                class="checkout-btn bg-white text-black font-display text-lg tracking-[0.15em] uppercase px-10 py-4 hover:bg-gray-200 transition-colors w-full sm:w-auto rounded-[10px] disabled:opacity-40 disabled:cursor-not-allowed">
                Purchase All
            </button>
        </form>
    </div>
</div>

</x-layout>
