<x-layout title="Home | E-COMMERCE-SHOE-WEBSITE">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>


<div class="p-8">

    <!-- Top Section -->
    <div class="grid grid-cols-2 gap-8">

        <!-- Product Image -->
        <div class="bg-gray-200 flex items-center justify-center h-[300px]">
            <img src="/images/shoe.png" class="h-40">
        </div>

        <!-- Product Info -->
        <div class="flex flex-col gap-4">

            <div class="flex justify-between items-start">
                <h1 class="text-lg font-semibold leading-tight">
                    Adizero EVO SL Shoes <br>
                    <span class="font-normal text-gray-300 text-sm">Unisex in For All Time</span>
                </h1>

                <button class="border rounded-full w-8 h-8 flex items-center justify-center hover:bg-white hover:text-black">
                    ♥
                </button>
            </div>

            <div class="text-xl font-bold">₱ 7,100.00</div>

            <!-- Dropdowns -->
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <label class="block mb-1 text-gray-400">SIZE</label>
                    <select class="w-full bg-[#2a2a2a] border border-gray-600 p-2 rounded">
                        <option>41-42</option>
                        <option>42-43</option>
                        <option>43-44</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-gray-400">PAYMENT</label>
                    <select class="w-full bg-[#2a2a2a] border border-gray-600 p-2 rounded">
                        <option>COD</option>
                        <option>GCash</option>
                        <option>Card</option>
                    </select>
                </div>
            </div>

            <!-- Fake Button -->
            <button class="bg-gray-300 text-black py-2 rounded text-sm">
                Button
            </button>

            <!-- Description -->
            <div class="border border-gray-700 rounded p-4 text-sm">
                <div class="font-semibold mb-2">Adidas Samba</div>
                <p class="text-gray-400 text-xs leading-relaxed">
                    These shoes are a great choice for casual wear because they are lightweight,
                    comfortable, and easy to style. The design is simple and clean, so you can
                    pair them with jeans, joggers, or shorts without any effort.
                </p>

                <button class="mt-4 w-full bg-gray-300 text-black py-2 rounded text-xs">
                    ADD TO CART
                </button>
            </div>

        </div>
    </div>

    <!-- Reviews Section -->
    <div class="mt-16">
        <h2 class="text-sm mb-4">Latest reviews</h2>

        <div class="grid grid-cols-3 gap-6">

            <!-- Review Card -->
            @for ($i = 0; $i < 3; $i++)
            <div class="border border-gray-700 rounded p-4 text-xs">
                <div class="mb-2 text-gray-400">★★★★★</div>

                <div class="font-semibold text-sm mb-1">
                    ADIDAS SAMBA - PINK
                </div>

                <div class="text-gray-400 mb-2">GOOD QUALITY!!</div>

                <div class="text-gray-500 text-[10px]">3/23/26</div>
            </div>
            @endfor

        </div>
    </div>

    <!-- Newsletter -->
    <div class="mt-16 text-center">
        <h3 class="text-sm font-semibold">Follow the latest trends</h3>
        <p class="text-xs text-gray-400 mb-4">With our daily newsletter</p>

        <div class="flex justify-center gap-2">
            <input type="text" placeholder="you@example.com"
                   class="bg-[#2a2a2a] border border-gray-600 px-3 py-2 text-xs rounded w-56">

            <button class="bg-gray-300 text-black px-4 py-2 text-xs rounded">
                Submit
            </button>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-16 text-xs text-gray-400 flex justify-between items-center">
        <div>FOLLOW US ON :</div>
        <div class="flex gap-3">
            <span>✕</span>
            <span>◎</span>
            <span>▶</span>
        </div>
    </div>

</div>

</x-layouts>