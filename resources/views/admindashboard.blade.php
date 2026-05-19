<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="min-h-screen bg-[#050505] text-white font-sans flex flex-col antialiased">

    <header class="relative flex flex-col gap-4 px-6 py-4 bg-black/80 border-b border-white/10 backdrop-blur-xl md:flex-row md:items-center md:justify-between">

    {{-- LOGO --}}
    <div class="flex items-center gap-3">
        <img src="{{ asset('img/logo.png') }}"
             class="w-28 rounded-xl ring-1 ring-white/10 shadow-2xl shadow-black/40 transition duration-300 hover:scale-105">
    </div>

    {{-- CENTER NAV --}}
    <nav class="flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] p-1 md:absolute md:left-1/2 md:-translate-x-1/2">

        <a href="/admin/dashboard"
           class="px-4 py-2 rounded-full text-xs font-black uppercase tracking-[0.18em] bg-white text-black shadow-lg">
            Dashboard
        </a>

        <a href="/admin/products"
           class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-[0.18em] text-white/60 transition hover:bg-white/10 hover:text-white">
            Products
        </a>

    </nav>

    {{-- LOGOUT --}}
    <form method="POST" action="/logout">
        @csrf
        <button type="submit"
            class="rounded-full bg-white px-4 py-2 text-xs font-black uppercase tracking-[0.18em] text-black transition duration-300 hover:bg-lime-300 cursor-pointer">
            LOG OUT
        </button>
    </form>

</header>

    <div class="flex flex-1">

        {{-- MAIN --}}
        <main class="flex-1 p-6 space-y-6 overflow-y-auto">

            <div>
                <p class="text-xs font-bold uppercase tracking-[0.35em] text-lime-300">Admin Control</p>
                <h1 class="mt-2 text-3xl font-black uppercase tracking-tight md:text-5xl">Dashboard</h1>
            </div>

            {{-- STATS --}}
            <div class="grid md:grid-cols-3 gap-5">

                <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-6 shadow-2xl shadow-black/25 transition duration-300 hover:-translate-y-1 hover:border-lime-300/40">
                    <p class="text-lime-300 text-xs uppercase tracking-[0.25em] mb-2">Purchased Products</p>
                    <h1 class="text-4xl font-black">
                        {{ $purchases->sum(fn ($p) => $p->items->sum('quantity')) }}
                    </h1>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-6 shadow-2xl shadow-black/25 transition duration-300 hover:-translate-y-1 hover:border-white/25">
                    <p class="text-white/50 text-xs uppercase tracking-[0.25em] mb-2">Total Orders</p>
                    <h2 class="text-4xl font-black">
                        {{ $purchases->count() }}
                    </h2>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-6 shadow-2xl shadow-black/25 transition duration-300 hover:-translate-y-1 hover:border-lime-300/40">
                    <p class="text-white/50 text-xs uppercase tracking-[0.25em] mb-2">Total Sales</p>
                    <h2 class="text-3xl font-black text-lime-300">
                        Php {{ number_format($purchases->sum(fn ($p) => (float) $p->total_price), 2) }}
                    </h2>
                </div>

            </div>

            {{-- TABLE --}}
            <section class="rounded-2xl border border-white/10 bg-white/[0.04] p-6 shadow-2xl shadow-black/25">

                <h2 class="text-lg font-black uppercase tracking-wide mb-4">Recent Orders</h2>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="text-white/40 text-xs uppercase tracking-[0.16em]">
                            <tr class="border-b border-white/10">
                                <th class="text-left py-3">Order</th>
                                <th class="text-left py-3">Customer</th>
                                <th class="text-left py-3">Address</th>
                                <th class="text-left py-3">Products</th>
                                <th class="text-left py-3">Payment</th>
                                <th class="text-right py-3">Total</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($purchases as $purchase)
                                <tr class="border-b border-white/5 transition hover:bg-white/[0.04]">

                                    <td class="py-3 text-white/80">#{{ $purchase->id }}</td>

                                    <td class="py-3 text-white/80">{{ $purchase->full_name }}</td>

                                    <td class="py-3 text-white/70">{{ $purchase->address }}</td>

                                    <td class="py-3 text-white/80">
                                        {{ $purchase->items->map(fn ($item) => $item->product_name . ' [' . $item->quantity . ']' )->join(' | ') }}
                                    </td>

                                    <td class="py-3 text-white/80">
                                        {{ $purchase->payment_method }}
                                    </td>

                                    <td class="py-3 text-right font-black text-lime-300">
                                        Php {{ number_format($purchase->total_price, 2) }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="py-8 text-center text-white/40">
                                        No purchases yet.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

            {{-- STOCK --}}
            <section class="rounded-2xl border border-white/10 bg-white/[0.04] p-6 shadow-2xl shadow-black/25">

                <h2 class="text-lg font-black uppercase tracking-wide mb-4">Stock Levels</h2>

                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">

                    @foreach ($products as $product)
                        <div class="rounded-2xl border border-white/10 bg-black/40 p-4 transition duration-300 hover:-translate-y-1 hover:border-white/25">

                            <div class="flex justify-between items-start gap-4">

                                <div>
                                    <p class="font-black uppercase tracking-wide">{{ $product->name }}</p>
                                    <p class="text-xs text-white/40 capitalize">
                                        {{ $product->category }}
                                    </p>
                                </div>

                                <div class="text-2xl font-black
                                    {{ $product->stock <= 3 ? 'text-red-400' : 'text-lime-300' }}">
                                    {{ $product->stock }}
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

            </section>

        </main>

    </div>

</div>
