<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="min-h-screen bg-[#0f1117] text-white font-sans flex flex-col">

    <header class="relative flex items-center justify-between px-6 py-4 bg-[#151823] border-b border-white/5">

    {{-- LOGO --}}
    <div class="flex items-center gap-3">
        <img src="{{ asset('img/logo.png') }}"
             class="w-28 rounded-lg shadow-md hover:scale-105 transition">
    </div>

    {{-- CENTER NAV --}}
    <nav class="absolute left-1/2 -translate-x-1/2 flex items-center gap-3">

        <a href="/admin/dashboard"
           class="px-4 py-2 rounded-lg text-sm font-medium bg-white/10 text-white border border-white/10">
            Dashboard
        </a>

        <a href="/admin/products"
           class="px-4 py-2 rounded-lg text-sm text-white/60 hover:text-white hover:bg-white/5 transition">
            Products
        </a>

    </nav>

    {{-- LOGOUT --}}
    <form method="POST" action="/logout">
        @csrf
        <button type="submit"
            class="bg-white text-black px-3 py-1 rounded hover:bg-gray-400 transition cursor-pointer font-bold">
            LOG OUT
        </button>
    </form>

</header>

    <div class="flex flex-1">

        {{-- MAIN --}}
        <main class="flex-1 p-6 space-y-6 overflow-y-auto">

            {{-- STATS --}}
            <div class="grid md:grid-cols-3 gap-5">

                <div class="bg-[#151823] border border-white/5 rounded-2xl p-6 hover:scale-[1.02] transition">
                    <p class="text-indigo-300 text-xs uppercase tracking-widest mb-2">Purchased Products</p>
                    <h1 class="text-4xl font-bold">
                        {{ $purchases->sum(fn ($p) => $p->items->count()) }}
                    </h1>
                </div>

                <div class="bg-[#151823] border border-white/5 rounded-2xl p-6 hover:scale-[1.02] transition">
                    <p class="text-white/50 text-xs uppercase tracking-widest mb-2">Total Orders</p>
                    <h2 class="text-4xl font-bold">
                        {{ $purchases->count() }}
                    </h2>
                </div>

                <div class="bg-[#151823] border border-white/5 rounded-2xl p-6 hover:scale-[1.02] transition">
                    <p class="text-white/50 text-xs uppercase tracking-widest mb-2">Total Sales</p>
                    <h2 class="text-3xl font-bold text-green-300">
                        ₱{{ number_format($purchases->sum(fn ($p) => (float) $p->total_price), 2) }}
                    </h2>
                </div>

            </div>

            {{-- TABLE --}}
            <section class="bg-[#151823] border border-white/5 rounded-2xl p-6">

                <h2 class="text-lg font-semibold mb-4">Recent Orders</h2>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="text-white/40 text-xs uppercase">
                            <tr class="border-b border-white/10">
                                <th class="text-left py-3">Order</th>
                                <th class="text-left py-3">Customer</th>
                                <th class="text-left py-3">Products</th>
                                <th class="text-left py-3">Payment</th>
                                <th class="text-right py-3">Total</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($purchases as $purchase)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition">

                                    <td class="py-3 text-white/80">#{{ $purchase->id }}</td>

                                    <td class="py-3 text-white/80">{{ $purchase->full_name }}</td>

                                    <td class="py-3 text-white/80">
                                        {{ $purchase->items->pluck('product_name')->join(', ') }}
                                    </td>

                                    <td class="py-3 text-white/80">
                                        {{ $purchase->payment_method }}
                                    </td>

                                    <td class="py-3 text-right font-semibold text-green-300">
                                        ₱{{ number_format($purchase->total_price, 2) }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="py-8 text-center text-white/40">
                                        No purchases yet.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

            {{-- STOCK --}}
            <section class="bg-[#151823] border border-white/5 rounded-2xl p-6">

                <h2 class="text-lg font-semibold mb-4">Stock Levels</h2>

                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">

                    @foreach ($products as $product)
                        <div class="bg-[#0f1117] border border-white/5 rounded-xl p-4 hover:border-white/20 transition">

                            <div class="flex justify-between items-start">

                                <div>
                                    <p class="font-semibold">{{ $product->name }}</p>
                                    <p class="text-xs text-white/40 capitalize">
                                        {{ $product->category }}
                                    </p>
                                </div>

                                <div class="text-2xl font-bold
                                    {{ $product->stock <= 3 ? 'text-red-400' : 'text-green-300' }}">
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