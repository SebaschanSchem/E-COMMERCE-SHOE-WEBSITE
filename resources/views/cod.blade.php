<x-layout title="Home | E-COMMERCE-SHOE-WEBSITE">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<!-- Background -->
<div class="absolute inset-0 bg-cover bg-center opacity-30"
     style="background-image: url('/images/bg.jpg');">
</div>

<div class="relative z-10 p-6">
    <!-- Delivery Address -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">delivery address</h2>

        <div class="flex justify-between text-xs text-gray-300">
            <div>
                Dasmariñas, Crisforte Karrie (+63)<br>
                965 328 8219
            </div>

            <div class="text-right">
                Prk 1, Balagunan Dasmariñas likod sa balagunan national high school,
                Balagunan, Santo Tomas, Mindanao, Davao Del Norte 8112
            </div>
        </div>

        <div class="flex gap-2 mt-2 justify-end">
            <button class="bg-gray-700 px-2 py-1 text-[10px] rounded">default</button>
            <button class="bg-gray-700 px-2 py-1 text-[10px] rounded">change</button>
        </div>
    </div>

    <hr class="border-gray-700 my-6">

    <!-- Products Ordered -->
    <div>
        <h2 class="text-lg italic mb-4">Products Ordered</h2>

        <!-- Table Header -->
        <div class="grid grid-cols-5 text-xs text-gray-400 mb-3">
            <div class="col-span-2"></div>
            <div>Unit Price</div>
            <div>QuantityItem</div>
            <div>Subtotal</div>
        </div>

        <!-- Product Item -->
        @for ($i = 0; $i < 3; $i++)
        <div class="grid grid-cols-5 items-center gap-4 mb-6">

            <!-- Image + Name -->
            <div class="col-span-2 flex gap-3 items-center">
                <div class="bg-gray-200 w-20 h-20 flex items-center justify-center">
                    <img src="/images/shoe.png" class="h-12">
                </div>

                <div class="text-xs">
                    <div class="font-semibold">Adizero EVO SL Shoes</div>
                    <div class="text-gray-400">Unisex in For All Time</div>
                    <div class="text-gray-500 text-[10px]">SIZE: 42</div>
                </div>
            </div>

            <div class="text-xs">₱ 6,800</div>
            <div class="text-xs text-center">2</div>
            <div class="text-xs">₱ 13,600</div>
        </div>
        @endfor

    </div>

    <!-- Protection -->
    <div class="text-[10px] text-gray-400 mt-6">
        <span class="text-red-400">Merchandise Protection</span><br>
        safeguard items from accidental damage and liquid damage after shipping.
    </div>

    <hr class="border-gray-700 my-6">

    <!-- Voucher + Invoice -->
    <div class="grid grid-cols-2 gap-6 text-xs">

        <!-- Left -->
        <div>
            <div class="mb-2">E-Invoice Request Now</div>
            <input type="text" placeholder="0000-0000-0000"
                   class="bg-[#2a2a2a] border border-gray-600 px-2 py-1 rounded w-full text-xs">
        </div>

        <!-- Right -->
        <div class="text-right">
            <button class="bg-gray-700 px-3 py-1 rounded mb-2 text-[10px]">
                Select Voucher
            </button>

            <div class="text-gray-400 text-[10px]">CHANGE</div>
            <div>₱ 525</div>
        </div>

    </div>

    <!-- Shipping -->
    <div class="mt-6 text-xs text-gray-300">
        <div class="font-semibold">Overseas Shipping</div>
        <div>Standard delivery fee</div>
        <div class="text-gray-500 text-[10px]">
            Estimated shipping: Apr 29 - May 7
        </div>
    </div>

    <!-- Guarantee -->
    <div class="text-green-400 text-xs mt-4">
        Guaranteed to get by 25 - 27 Apr
    </div>

    <!-- Total -->
    <div class="flex justify-end mt-6 text-sm">
        <div>
            <span class="text-gray-400 text-xs">Order Total (7 items):</span>
            <span class="ml-2 text-lg font-semibold">42,313</span>
        </div>
    </div>

</div>

</x-layout>