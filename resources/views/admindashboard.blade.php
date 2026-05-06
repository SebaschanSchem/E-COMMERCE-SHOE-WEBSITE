<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="min-h-screen bg-[#13132a] font-sans flex flex-col text-white">
    <header class="flex items-center justify-between px-5 py-3 bg-[#22223b] border-b border-[#33335a]">
        <div class="flex items-center gap-3">
            <img src="{{ asset('img/logo.png') }}" class="w-28 rounded-[10px]">
        </div>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="text-sm text-white/70 hover:text-white transition">Log Out</button>
        </form>
    </header>

    <div class="flex flex-1">
        <aside class="w-52 shrink-0 bg-[#22223b] border-r border-[#33335a] flex flex-col py-4">
            <nav class="flex flex-col gap-1 px-2">
                <a href="/admin/dashboard" class="px-3 py-2.5 rounded-lg text-sm font-medium text-indigo-300 bg-indigo-500/10 border-l-2 border-indigo-500 transition">Dashboard</a>
                <a href="/admin/products" class="px-3 py-2.5 rounded-lg text-sm text-white/50 hover:bg-white/5 hover:text-white transition">Product</a>
            </nav>
        </aside>

        <main class="flex-1 p-6 space-y-6 overflow-y-auto">
            <div class="grid md:grid-cols-3 gap-5">
                <div class="bg-[#22223b] border border-[#33335a] rounded-2xl p-6">
                    <p class="text-indigo-400 text-sm font-medium tracking-widest uppercase mb-1">Purchased Products</p>
                    <h1 class="text-white text-4xl font-bold font-mono">{{ $purchases->sum(fn ($purchase) => $purchase->items->count()) }}</h1>
                </div>

                <div class="bg-[#22223b] border border-[#33335a] rounded-2xl p-6">
                    <p class="text-white/50 text-sm font-medium tracking-widest uppercase mb-1">Total Orders</p>
                    <h2 class="text-white text-4xl font-bold font-mono">{{ $purchases->count() }}</h2>
                </div>

                <div class="bg-[#22223b] border border-[#33335a] rounded-2xl p-6">
                    <p class="text-white/50 text-sm font-medium tracking-widest uppercase mb-1">Total Sales</p>
                    <h2 class="text-white text-3xl font-bold font-mono">Php {{ number_format($purchases->sum(fn ($purchase) => (float) $purchase->total_price), 2) }}</h2>
                </div>
            </div>

            <section class="bg-[#22223b] border border-[#33335a] rounded-2xl p-6">
                <h2 class="text-lg font-bold mb-4">Purchased Products</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="text-white/40 uppercase text-xs">
                            <tr>
                                <th class="text-left py-2">Order</th>
                                <th class="text-left py-2">Customer</th>
                                <th class="text-left py-2">Products</th>
                                <th class="text-left py-2">Payment</th>
                                <th class="text-right py-2">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#33335a]">
                            @forelse ($purchases as $purchase)
                                <tr>
                                    <td class="py-3">#{{ $purchase->id }}</td>
                                    <td class="py-3">{{ $purchase->full_name }}</td>
                                    <td class="py-3">
                                        {{ $purchase->items->pluck('product_name')->join(', ') }}
                                    </td>
                                    <td class="py-3">{{ $purchase->payment_method }}</td>
                                    <td class="py-3 text-right">Php {{ number_format($purchase->total_price, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-white/50">No purchases yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="bg-[#22223b] border border-[#33335a] rounded-2xl p-6">
                <h2 class="text-lg font-bold mb-4">Stock Levels</h2>
                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
                    @foreach ($products as $product)
                        <div class="bg-[#2a2a45] border border-[#33335a] rounded-xl p-4">
                            <div class="flex justify-between gap-4">
                                <div>
                                    <p class="font-semibold">{{ $product->name }}</p>
                                    <p class="text-xs text-white/40 capitalize">{{ $product->category }}</p>
                                </div>
                                <p class="text-2xl font-bold {{ $product->stock <= 3 ? 'text-red-300' : 'text-indigo-300' }}">{{ $product->stock }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
</div>
