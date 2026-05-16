<x-layout title="Cart | E-COMMERCE-SHOE-WEBSITE">

<div class="min-h-screen bg-white text-black">

    <div class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-6 py-3 flex items-center gap-2">
            <span class="font-mono text-xs text-black uppercase tracking-widest">Cart</span>
            <span class="text-gray-300">/</span>
            <span class="font-mono text-xs text-black uppercase tracking-widest">Your Items</span>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-10 bg-white text-black">

        {{-- STATUS --}}
        @if (session('status'))
    <div 
        id="toast-notification"
        class="fixed top-1/2 left-1/2 z-50
               -translate-x-1/2 -translate-y-1/2
               w-[340px] max-w-[90%]
               rounded-xl bg-red-500 text-white
               px-5 py-4 text-sm text-center
               shadow-2xl
               opacity-0 scale-95
               transition-all duration-500 ease-in-out">

        {{ session('status') }}
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toast = document.getElementById("toast-notification");

            // show
            setTimeout(() => {
                toast.classList.remove("opacity-0", "scale-95");
                toast.classList.add("opacity-100", "scale-100");
            }, 100);

            // hide after 2 seconds
            setTimeout(() => {
                toast.classList.remove("opacity-100", "scale-100");
                toast.classList.add("opacity-0", "scale-95");

                setTimeout(() => {
                    toast.remove();
                }, 500);
            }, 2000);
        });
    </script>
@endif

        @if($products->isEmpty())
            <div class="text-center py-20 border border-gray-200 rounded-lg">
                <p class="text-lg font-semibold">Your cart is empty</p>
                <p class="text-sm text-gray-500 mt-1">Start adding your favorite shoes 👟</p>
            </div>
        @else

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT: ITEMS --}}
            <div class="lg:col-span-2 space-y-4">

                @foreach ($products as $product)
                    @php
                        $image = str_starts_with($product->image, 'http') ? $product->image : asset($product->image);
                    @endphp

                    <div class="flex gap-5 border border-gray-200 rounded-xl p-4 hover:border-black transition bg-white">

                        <div class="w-28 h-28 bg-white border border-gray-200 rounded-lg flex items-center justify-center">
                            <img src="{{ $image }}" class="w-full h-full object-contain">
                        </div>

                        <div class="flex-1 flex flex-col justify-between">

                            <div>
                                <h2 class="font-semibold text-sm uppercase tracking-widest">
                                    {{ $product->name }}
                                </h2>
                                <p class="text-xs text-gray-500 capitalize">
                                    {{ $product->category }}
                                </p>
                            </div>

                            <div class="flex items-end justify-between">

                                <p class="text-xl font-bold">
                                    ₱{{ number_format($product->price, 2) }}
                                </p>

                                <div>
                                    <label class="text-xs text-gray-500 uppercase tracking-widest">Size</label>
                                    <select class="block mt-1 border border-gray-300 rounded px-2 py-1 text-sm bg-white text-black">
                                        <option>41-42</option>
                                        <option>43-44</option>
                                        <option>45-46</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <form method="POST" action="/cart/{{ $product->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-black hover:text-red-500 text-sm">
                                ✕
                            </button>
                        </form>

                    </div>
                @endforeach

            </div>

            {{-- RIGHT: SUMMARY --}}
            <div class="lg:col-span-1">
                <div class="border border-gray-200 rounded-xl p-6 sticky top-6 bg-white">

                    <h3 class="text-sm uppercase tracking-widest mb-4">Order Summary</h3>

                    <div class="flex justify-between text-sm mb-2">
                        <span>Items</span>
                        <span>{{ $products->count() }}</span>
                    </div>

                    <div class="flex justify-between text-sm mb-6">
                        <span>Total</span>
                        <span class="font-bold">
                            ₱{{ number_format($products->sum(fn($p) => $p->price), 2) }}
                        </span>
                    </div>

                    <form method="POST" action="/cart/purchase-all">
                        @csrf
                        <button
                            @disabled($products->isEmpty())
                            class="w-full bg-black text-white py-3 rounded-lg text-sm uppercase tracking-widest hover:bg-gray-800 transition disabled:opacity-40">
                            Checkout
                        </button>
                    </form>

                    <p class="text-xs text-gray-500 mt-3 text-center">
                        Secure checkout powered by your system
                    </p>

                </div>
            </div>

        </div>

        @endif

    </div>

</div>

</x-layout>