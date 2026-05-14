<x-layout title="Home | E-COMMERCE-SHOE-WEBSITE">

<section class="bg-white text-black">

    <div class="max-w-6xl mx-auto py-10 px-6">

        <div class="relative flex justify-center">
    <div id="shoe-container"
         class="w-full h-[500px]">
    </div>
</div>

    </div>

</section>

<section class="bg-[#111] py-12 px-6 text-white">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8 tracking-wide">AVAILABLE PRODUCTS</h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($featuredProducts as $product)
                @php
                    $image = str_starts_with($product->image, 'http') ? $product->image : asset($product->image);
                @endphp

                <a href="/purchase/{{ $product->id }}" class="group bg-black border border-gray-800 rounded-lg p-4 hover:border-white/50 transition">
                    <div class="bg-white h-56 rounded-md flex items-center justify-center overflow-hidden mb-4">
                        <img src="{{ $image }}" alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition">
                    </div>
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="font-bold">{{ $product->name }}</h3>
                            <p class="text-xs uppercase tracking-widest text-gray-400">{{ $product->category }}</p>
                        </div>
                        <p class="font-bold">Php {{ number_format($product->price, 2) }}</p>
                    </div>
                </a>
            @empty
                <div class="lg:col-span-3 text-center text-gray-300">
                    NO PRODUCTS AVAILABLE!!
                </div>
            @endforelse
        </div>
    </div>
</section>


<section class="bg-[url('/img/bgforhome.jpg')] bg-center py-14 px-6 text-white">

    <div class="max-w-6xl mx-auto">

        <h2 class="text-3xl font-bold text-center mb-8 tracking-wide">TRENDING</h2>
        <br>

        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div class="bg-white p-4 rounded-xl">
                <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/shoe-poster-design-template-4166448a83bcad7c01288993606a0049_screen.jpg?ts=1719595955"
                     class="w-full rounded-lg">
            </div>

            <div>
                <h3 class="text-2xl font-bold mb-4">NIKE SAPATOSAN</h3>

                <p class="text-gray-300 text-sm leading-relaxed mb-4">
                    Nike is a well-known brand that people like because it feels good to wear and looks stylish at the same time. One of its biggest benefits is comfort—its shoes and clothes are made with lightweight and breathable materials, so they’re great for everyday use or sports.
                </p>

                <p class="text-gray-300 text-sm leading-relaxed">
                    Another thing people like is performance. Nike shoes are designed with good cushioning and support, which helps when running, walking, or working out. They also last a long time, even if you use them often.
                </p>
            </div>
        </div>
    </div>

    <br>
    <h2 class="text-3xl font-bold text-center mb-8 tracking-wide">LAYOUT</h2>
    <br>

    <div class="max-w-6xl mx-auto">

        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div class="bg-white p-4 rounded-xl">
                <img src="https://feetfirstclinic.com/wp-content/uploads/runningshoes1.jpg.webp"
                     class="w-full rounded-lg">
            </div>

            <div>
                <h3 class="text-2xl font-bold mb-4">HOW IT MADE</h3>

                <p class="text-gray-300 text-sm leading-relaxed mb-4">
                    how each section—like the toe box, laces, insole, midsole, and outsole—helps provide comfort, support, fit, and stability when walking or running.
                </p>

                <p class="text-gray-300 text-sm leading-relaxed">
                    the anatomy of a shoe by breaking it down into different parts and explaining the function of each. The upper section includes the toe box, which provides space for the toes to move comfortably, the laces that secure the shoe for a proper fit, and the collar and heel counter that support and stabilize the ankle and heel. The body of the shoe is made from flexible material to adapt to the shape of the foot. Inside, the insole helps distribute pressure evenly.
                </p>
            </div>
            <br>

        </div>

        <div class="text-center mb-10">

    <h2 class="text-3xl font-bold mb-6 tracking-wide text-center">AVAILABLE IN:</h2>

<div class="flex justify-center items-center gap-16">

    <div class="flex flex-col items-center">
        <img src="{{ asset('img/online.png') }}" class="w-full h-auto object-contain rounded-[10px]">
        <h3 class="mt-3 text-lg font-semibold">ONLINE</h3>
    </div>

    <div class="flex flex-col items-center">
        <img src="{{ asset('img/store.png') }}" class="w-full h-auto object-contain rounded-[10px]">
        <h3 class="mt-3 text-lg font-semibold">STORE</h3>
    </div>

</div>

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
    

</section>

</x-layout>
