<x-layout title="Home | E-COMMERCE-SHOE-WEBSITE">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
{{-- Page banner --}}
<div class="bg-darker border-b border-border">
    <div class="max-w-4xl mx-auto px-6 py-2 flex items-center gap-2">
        <span class="font-mono text-xs text-muted uppercase tracking-widest">Cart</span>
        <span class="text-border">/</span>
        <span class="font-mono text-xs text-gold uppercase tracking-widest">Your Items</span>
    </div>
</div>

<div class="max-w-4xl mx-auto px-6 py-10">

    {{-- CART ITEMS --}}
    <div class="space-y-3" id="cart-items">

        {{-- Item 1 --}}
        <div class="cart-item group relative flex items-start gap-5 bg-card rounded-sm p-4 border border-border hover:border-gold/30">

            {{-- Image --}}
            <div class="shrink-0 w-28 h-24 bg-[#2c2c2c] rounded-sm overflow-hidden flex items-center justify-center border border-border">
                <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSnvRodEiEqb4QZqvFoWw33tfPoj36YV4UDlg&s"
                    alt="Adizero EVO SL"
                    class="w-full h-full object-cover object-center"
                    onerror="this.src='https://placehold.co/112x96/2c2c2c/888888?text=Shoe'"
                >
            </div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <p class="font-body text-xs text-muted uppercase tracking-widest mb-0.5">Adizero EVO SL Shoes</p>
                <p class="font-body text-xs text-muted/60 mb-3">Unisex In For All Time</p>

                <div class="flex items-end justify-between gap-4 flex-wrap">
                    <div>
                        <p class="font-display text-3xl tracking-wider text-accent leading-none">₱ 6,800</p>
                    </div>
                    <div>
                        <label class="block font-mono text-xs text-muted uppercase tracking-widest mb-1">Size</label>
                        <select class="bg-darker border border-border text-accent text-xs font-body px-3 py-1.5 focus:outline-none focus:border-gold transition-colors min-w-[90px]">
                            <option>41-42</option>
                            <option>43-44</option>
                            <option>45-46</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Wishlist --}}
            <button
                class="wish-btn absolute top-4 right-4 text-muted"
                onclick="toggleWish(this)"
                aria-label="Add to wishlist"
            >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </button>
        </div>

        {{-- Item 2 --}}
        <div class="cart-item group relative flex items-start gap-5 bg-card rounded-sm p-4 border border-border hover:border-gold/30">

            <div class="shrink-0 w-28 h-24 bg-[#2c2c2c] rounded-sm overflow-hidden flex items-center justify-center border border-border">
                <img
                    src="https://www.slamdunk.gr/2960984-product_large/jordan-air-1-mid-se.jpg"
                    alt="Air Jordan 1 Mid SE"
                    class="w-full h-full object-cover object-center"
                    onerror="this.src='https://placehold.co/112x96/2c2c2c/888888?text=Shoe'"
                >
            </div>

            <div class="flex-1 min-w-0">
                <p class="font-body text-xs text-muted uppercase tracking-widest mb-0.5">Air Jordan 1 Mid SE</p>
                <p class="font-body text-xs text-muted/60 mb-3">&nbsp;</p>

                <div class="flex items-end justify-between gap-4 flex-wrap">
                    <div>
                        <p class="font-display text-3xl tracking-wider text-accent leading-none">₱ 5,527.00</p>
                    </div>
                    <div>
                        <label class="block font-mono text-xs text-muted uppercase tracking-widest mb-1">Size</label>
                        <select class="bg-darker border border-border text-accent text-xs font-body px-3 py-1.5 focus:outline-none focus:border-gold transition-colors min-w-[90px]">
                            <option>41-42</option>
                            <option>43-44</option>
                            <option>45-46</option>
                        </select>
                    </div>
                </div>
            </div>

            <button
                class="wish-btn absolute top-4 right-4 text-muted"
                onclick="toggleWish(this)"
                aria-label="Add to wishlist"
            >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </button>
        </div>

        {{-- Item 3 --}}
        <div class="cart-item group relative flex items-start gap-5 bg-card rounded-sm p-4 border border-border hover:border-gold/30">

            <div class="shrink-0 w-28 h-24 bg-[#2c2c2c] rounded-sm overflow-hidden flex items-center justify-center border border-border">
                <img
                    src="https://asics.scene7.com/is/image/asics/1183C430_020_SR_RT_GLB?$otmag_zoom$&qlt=99,1"
                    alt="Tokuten"
                    class="w-full h-full object-cover object-center"
                    onerror="this.src='https://placehold.co/112x96/2c2c2c/888888?text=Shoe'"
                >
            </div>

            <div class="flex-1 min-w-0">
                <p class="font-body text-xs text-muted uppercase tracking-widest mb-0.5">Tokuten</p>
                <p class="font-body text-xs text-muted/60 mb-3">&nbsp;</p>

                <div class="flex items-end justify-between gap-4 flex-wrap">
                    <div>
                        <p class="font-display text-3xl tracking-wider text-accent leading-none">9,720.00</p>
                    </div>
                    <div>
                        <label class="block font-mono text-xs text-muted uppercase tracking-widest mb-1">Size</label>
                        <select class="bg-darker border border-border text-accent text-xs font-body px-3 py-1.5 focus:outline-none focus:border-gold transition-colors min-w-[90px]">
                            <option>41-42</option>
                            <option>43-44</option>
                            <option>45-46</option>
                        </select>
                    </div>
                </div>
            </div>

            <button
                class="wish-btn absolute top-4 right-4 text-muted"
                onclick="toggleWish(this)"
                aria-label="Add to wishlist"
            >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </button>
        </div>

    </div>

    {{-- ORDER SUMMARY --}}
    <div class="mt-8 pt-6 border-t border-border flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">

        <div class="space-y-1">
            <div class="flex items-center gap-4">
                <span class="font-body text-xs text-muted uppercase tracking-widest">Items (3)</span>
                <span class="font-mono text-xs text-muted">·</span>
                <span class="font-body text-xs text-muted">Free shipping on orders over ₱2,000</span>
            </div>
            <div class="flex items-baseline gap-3">
                <span class="font-body text-sm text-muted">Total</span>
                <span class="font-display text-4xl tracking-wider text-gold">₱ 22,047.00</span>
            </div>
        </div>

        <a href="/cod"
   class="checkout-btn bg-white text-black font-display text-lg tracking-[0.15em] uppercase px-10 py-4 hover:bg-gray-200 transition-colors w-full sm:w-auto rounded-[10px] inline-block text-center">
    Checkout Now
</a>
    </div>

    <div class="relative z-10 flex flex-col items-center px-6 text-center">
        <br>
        <h1>FOLLOW US ON:</h1>

        <div class="mt-10 flex gap-6 text-blue-200/70">
            <img src="{{ asset('img/yt.png') }}" 
                 alt="YouTube"
                 class="w-32 h-32 hover:scale-110 transition cursor-pointer">
            <img src="{{ asset('img/ig.png') }}" 
                 alt="IG"
                 class="w-32 h-32 hover:scale-110 transition cursor-pointer">
            <img src="{{ asset('img/x.png') }}" 
                 alt="X"
                 class="w-32 h-32 hover:scale-110 transition cursor-pointer">
        </div>

        </div>

</div>

<script>
    function toggleWish(btn) {
        btn.classList.toggle('active');
    }
</script>

</x-layout>