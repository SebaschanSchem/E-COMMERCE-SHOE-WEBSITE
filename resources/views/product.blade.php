<x-layout title="Products | E-COMMERCE-SHOE-WEBSITE">

<section class="relative min-h-screen overflow-hidden bg-[#050505] px-6 py-12 text-white">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_0%,rgba(190,242,100,0.14),transparent_28%)]"></div>
    <div class="relative z-10 max-w-7xl mx-auto">
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

        @error('quantity')
            <div class="mb-6 rounded-2xl border border-red-300/30 bg-red-500/15 px-5 py-4 text-sm text-red-100">
                {{ $message }}
            </div>
        @enderror

        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.35em] text-lime-300">Sneaker Wall</p>
                <h1 class="text-3xl font-black uppercase tracking-tight md:text-5xl">Products</h1>
            </div>
            <p class="max-w-md text-sm leading-6 text-white/50">Filter the collection and pick your next daily rotation.</p>
        </div>

        <form method="GET" action="/products" id="filterForm" class="mb-6 flex flex-col md:flex-row gap-3">
            <input
                type="search"
                name="search"
                value="{{ $search }}"
                placeholder="Search shoes by name"
                class="w-full md:max-w-md rounded-full border border-white/10 bg-white/[0.06] px-5 py-3 text-sm text-white placeholder:text-white/35 shadow-xl shadow-black/20 transition focus:outline-none focus:border-lime-300/70 focus:bg-white/[0.09]"
            >

            @if ($category)
                <input type="hidden" name="category" value="{{ $category }}">
            @endif

            <button type="submit" class="rounded-full bg-white px-7 py-3 text-xs font-black uppercase tracking-[0.2em] text-black transition duration-300 hover:-translate-y-0.5 hover:bg-lime-300">
                Search
            </button>
        </form>

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar -->
            <aside class="w-full md:w-60 h-fit rounded-2xl border border-white/10 bg-white/[0.04] p-4 text-sm shadow-2xl shadow-black/25 backdrop-blur">
                <p class="font-black uppercase tracking-[0.25em] text-white/70 mb-3">Category</p>
                <div class="space-y-2">
                    <a href="/products{{ $search ? '?search=' . urlencode($search) : '' }}"
                       class="block rounded-xl px-3 py-2 transition {{ $category === '' ? 'bg-white text-black font-bold' : 'text-white/60 hover:bg-white/10 hover:text-white' }}">
                        All
                    </a>
                    @foreach ($categories as $item)
                        @php
                            $query = http_build_query(array_filter(['search' => $search, 'category' => $item]));
                        @endphp
                        <a href="/products?{{ $query }}"
                           class="block rounded-xl px-3 py-2 capitalize transition {{ $category === $item ? 'bg-white text-black font-bold' : 'text-white/60 hover:bg-white/10 hover:text-white' }}">
                            {{ $item }}
                        </a>
                    @endforeach
                </div>
            </aside>

            <!-- Product Grid -->
            <main class="flex-1">
                <div id="productGrid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($products as $product)
                        @php
                            $image = str_starts_with($product->image, 'http') ? $product->image : asset($product->image);
                        @endphp

                        <div class="product-card group rounded-2xl border border-white/10 bg-[#111] p-4 shadow-2xl shadow-black/30 transition duration-300 hover:-translate-y-2 hover:border-lime-300/50 hover:bg-[#151515]"
                             data-name="{{ strtolower($product->name) }}"
                             data-category="{{ $product->category }}">
                            <a href="/purchase/{{ $product->id }}" class="block">
                                <div class="h-48 flex items-center justify-center mb-4 rounded-xl overflow-hidden bg-gradient-to-br from-white via-zinc-100 to-zinc-300">
                                    <img src="{{ $image }}" alt="{{ $product->name }}" class="w-full h-full object-contain p-4 transition duration-500 group-hover:scale-110 group-hover:-rotate-2">
                                </div>

                                <h3 class="text-sm font-black uppercase tracking-wide">{{ $product->name }}</h3>
                                <p class="text-xs text-white/40 capitalize tracking-[0.2em]">{{ $product->category }}</p>

                                <div class="mt-3 text-lg font-black text-lime-300">Php {{ number_format($product->price, 2) }}</div>
                                <div class="text-xs text-white/40">Stock: {{ $product->stock }}</div>
                            </a>

                            <div class="mt-4 grid gap-2">
                                <form method="POST" action="/cart/{{ $product->id }}" class="grid grid-cols-[1fr_auto] gap-2">
                                    @csrf
                                    <input
                                        type="number"
                                        name="quantity"
                                        min="1"
                                        max="{{ min(99, $product->stock) }}"
                                        value="{{ old('quantity', 1) }}"
                                        required
                                        class="min-w-0 rounded-full border border-white/10 bg-white/[0.06] px-4 py-2 text-sm text-white focus:outline-none focus:border-lime-300/70">
                                    <button type="submit" class="rounded-full border border-white/15 px-4 py-2 text-white/80 transition duration-300 hover:border-pink-300 hover:bg-pink-500 hover:text-white" title="Add to cart">
                                        &#9829;
                                    </button>
                                </form>
                                <a href="/purchase/{{ $product->id }}" class="rounded-full bg-white py-2 text-center text-sm font-black text-black transition duration-300 hover:bg-lime-300">
                                    Purchase
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="sm:col-span-2 lg:col-span-3 rounded-2xl border border-white/10 bg-white/[0.04] p-10 text-center text-white/50">
                            No products available.
                        </div>
                    @endforelse
                </div>
            </main>
        </div>
    </div>
</section>

<script>
    const searchInput = document.querySelector('input[name="search"]');
    const productCards = [...document.querySelectorAll('.product-card')];

    searchInput?.addEventListener('input', (event) => {
        const value = event.target.value.trim().toLowerCase();

        productCards.forEach((card) => {
            card.classList.toggle('hidden', value !== '' && !card.dataset.name.includes(value));
        });
    });
</script>

</x-layout>
