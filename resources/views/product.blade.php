<x-layout title="Home | E-COMMERCE-SHOE-WEBSITE">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<section class="bg-[url('/img/bgproduct.jpg')] bg-center py-14 px-6 text-white">

<!-- Overlay Content -->
<div class="relative z-10">
    <!-- Sidebar + Products -->
    <div class="flex">

        <!-- Sidebar -->
        <aside class="w-48 p-4 text-xs border-r border-gray-700">
            <ul class="space-y-2">
                <li class="font-semibold">CATEGORY</li>
                <li><input type="checkbox"> Running</li>
                <li><input type="checkbox"> Casual</li>
                <li><input type="checkbox"> Basketball</li>

                <li class="mt-4 font-semibold">BRAND</li>
                <li><input type="checkbox"> Nike</li>
                <li><input type="checkbox"> Adidas</li>
                <li><input type="checkbox"> Puma</li>

                <li class="mt-4 font-semibold">PRICE</li>
                <li><input type="checkbox"> $0 - $50</li>
                <li><input type="checkbox"> $50 - $100</li>
                <li><input type="checkbox"> $100+</li>
            </ul>
        </aside>

        <!-- Product Grid -->
        <main class="flex-1 p-6">
            <div class="grid grid-cols-3 gap-6">

                <!-- Product Card -->
                @for ($i = 0; $i < 9; $i++)
                <div class="bg-gray-800 p-3 rounded shadow hover:scale-105 transition">
                    <div class="bg-gray-200 h-32 flex items-center justify-center mb-2">
                        <img src="/images/shoe.png" class="h-20">
                    </div>

                    <h3 class="text-sm font-semibold">Running Shoe</h3>
                    <p class="text-xs text-gray-400">Comfort wear</p>

                    <div class="mt-2 text-sm font-bold">$120.00</div>
                </div>
                @endfor

            </div>
        </main>

    </div>
</div>
</section>

</x-layouts>