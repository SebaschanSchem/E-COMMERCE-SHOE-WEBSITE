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
                            <img src="data:image/jpeg;base64,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" class="h-20">
                        </div>

                        <h3 class="text-sm font-semibold">Running Shoe</h3>
                        <p class="text-xs text-gray-400">Comfort wear</p>

                        <div class="mt-2 text-sm font-bold">$120.00</div>
                        
                    </div>
                    @endfor

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
            </main>

            
        </div>
    </div>
    </section>

    </x-layouts>