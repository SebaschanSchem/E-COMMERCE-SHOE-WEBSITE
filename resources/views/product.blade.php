<x-layout title="Products | E-COMMERCE-SHOE-WEBSITE">

<section class="bg-white py-14 px-6 text-white min-h-screen">
    <div class="relative z-10 max-w-7xl mx-auto">
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

        <form method="GET" action="/products" id="filterForm" class="mb-6 flex flex-col md:flex-row gap-3">
            <input
                type="search"
                name="search"
                value="{{ $search }}"
                placeholder="Search shoes by name"
                class="w-full md:max-w-md bg-black/70 border border-gray-700 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-blue-400 transition"
            >

            @if ($category)
                <input type="hidden" name="category" value="{{ $category }}">
            @endif

            <button type="submit" class="bg-black text-white px-6 py-3 rounded-lg text-sm font-bold hover:bg-gray-700 transition">
                Search
            </button>
        </form>

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar -->
            <aside class="w-full md:w-56 p-4 text-sm border border-gray-700 bg-black/70 rounded-lg h-fit">
                <p class="font-semibold mb-3">CATEGORY</p>
                <div class="space-y-2">
                    <a href="/products{{ $search ? '?search=' . urlencode($search) : '' }}"
                       class="block rounded px-3 py-2 {{ $category === '' ? 'bg-white text-black' : 'hover:bg-white/10' }}">
                        All
                    </a>
                    @foreach ($categories as $item)
                        @php
                            $query = http_build_query(array_filter(['search' => $search, 'category' => $item]));
                        @endphp
                        <a href="/products?{{ $query }}"
                           class="block rounded px-3 py-2 capitalize {{ $category === $item ? 'bg-white text-black' : 'hover:bg-white/10' }}">
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

                        <div class="product-card bg-gray-900/95 p-3 rounded-lg shadow hover:scale-[1.02] transition border border-gray-800"
                             data-name="{{ strtolower($product->name) }}"
                             data-category="{{ $product->category }}">
                            <a href="/purchase/{{ $product->id }}" class="block">
                                <div class="bg-gray-200 h-44 flex items-center justify-center mb-3 rounded overflow-hidden">
                                    <img src="{{ $image }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                                </div>

                                <h3 class="text-sm font-semibold">{{ $product->name }}</h3>
                                <p class="text-xs text-gray-400 capitalize">{{ $product->category }}</p>

                                <div class="mt-2 text-sm font-bold">Php {{ number_format($product->price, 2) }}</div>
                                <div class="text-xs text-gray-400">Stock: {{ $product->stock }}</div>
                            </a>

                            <div class="mt-3 flex gap-2">
                                <form method="POST" action="/cart/{{ $product->id }}" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full border border-pink-300 text-pink-200 rounded-lg py-2 hover:bg-pink-500 hover:text-white transition" title="Add to cart">
                                        &#9829;
                                    </button>
                                </form>
                                <a href="/purchase/{{ $product->id }}" class="flex-1 bg-white text-black rounded-lg py-2 text-center text-sm font-bold hover:bg-gray-200 transition">
                                    Purchase
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="sm:col-span-2 lg:col-span-3 bg-black/70 border border-gray-700 rounded-lg p-8 text-center text-gray-300">
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
