<x-layout title="Home | E-COMMERCE-SHOE-WEBSITE">

<style>
    html {
        scroll-behavior: smooth;
    }
</style>

<section class="relative overflow-hidden bg-[#050505] text-white">

    <div class="absolute inset-0 bg-[radial-gradient(circle_at_25%_15%,rgba(190,242,100,0.18),transparent_30%),linear-gradient(135deg,rgba(255,255,255,0.08),transparent_28%)]"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-12 md:py-16">

        <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">

            <div class="space-y-6">
                <p class="text-xs font-bold uppercase tracking-[0.35em] text-lime-300">Premium Sneaker Drop</p>
                <h1 class="text-4xl font-black uppercase leading-none tracking-tight text-white md:text-6xl">
                    Step Into<br>
                    Future Motion
                </h1>
                <p class="max-w-xl text-sm leading-7 text-white/60 md:text-base">
                    Discover sharp silhouettes, athletic comfort, and everyday streetwear energy from Sapatosan.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="/products" class="rounded-full bg-white px-6 py-3 text-xs font-black uppercase tracking-[0.22em] text-black shadow-2xl shadow-white/10 transition duration-300 hover:-translate-y-1 hover:bg-lime-300">
                        Shop Now
                    </a>
                    <a href="#featured-products" class="rounded-full border border-white/15 px-6 py-3 text-xs font-bold uppercase tracking-[0.22em] text-white/80 transition duration-300 hover:-translate-y-1 hover:border-white/40 hover:bg-white/10">
                        Explore
                    </a>
                </div>
            </div>

            <div class="relative flex justify-center">
                <div class="absolute inset-x-10 bottom-8 h-24 rounded-full bg-lime-300/20 blur-3xl"></div>
                <div id="shoe-container"
                     class="relative w-full h-[380px] md:h-[500px] rounded-[2rem] border border-white/10 bg-white/[0.03] shadow-[0_40px_120px_rgba(0,0,0,0.65)] backdrop-blur-sm overflow-hidden">
                </div>
            </div>

        </div>

    </div>

</section>

<section id="featured-products" class="bg-[#080808] py-16 px-6 text-white">
    <div class="max-w-6xl mx-auto">
        <div class="mb-9 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.35em] text-lime-300">Fresh Rotation</p>
                <h2 class="text-3xl font-black uppercase tracking-tight md:text-4xl">Available Products</h2>
            </div>
            <p class="max-w-md text-sm leading-6 text-white/50">Created shoes built for comfort, statement styling, and daily wear.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($featuredProducts as $product)
                @php
                    $image = str_starts_with($product->image, 'http') ? $product->image : asset($product->image);
                @endphp

                <a href="/purchase/{{ $product->id }}" class="group rounded-2xl border border-white/10 bg-[#111] p-4 shadow-2xl shadow-black/30 transition duration-300 hover:-translate-y-2 hover:border-lime-300/50 hover:bg-[#151515]">
                    <div class="h-56 rounded-xl flex items-center justify-center overflow-hidden mb-4 bg-gradient-to-br from-white via-zinc-100 to-zinc-300">
                        <img src="{{ $image }}" alt="{{ $product->name }}" class="w-full h-full object-contain p-4 transition duration-500 group-hover:scale-110 group-hover:-rotate-2">
                    </div>
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="font-black uppercase tracking-wide">{{ $product->name }}</h3>
                            <p class="text-xs uppercase tracking-[0.25em] text-white/40">{{ $product->category }}</p>
                        </div>
                        <p class="font-black text-lime-300">Php {{ number_format($product->price, 2) }}</p>
                    </div>
                </a>
            @empty
                <div class="lg:col-span-3 rounded-2xl border border-white/10 bg-white/[0.03] p-10 text-center text-white/50">
                    NO PRODUCTS AVAILABLE!!
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="bg-[#050505] py-16 px-6 text-white">

    <div class="max-w-6xl mx-auto">

        <div class="mb-10 text-center">
            <p class="text-xs font-bold uppercase tracking-[0.35em] text-lime-300">Spotlight</p>
            <h2 class="text-3xl font-black uppercase tracking-tight text-white md:text-4xl">Trending</h2>
        </div>

        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-3 shadow-2xl shadow-black/40 transition duration-300 hover:-translate-y-2 hover:border-white/25">
                <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/shoe-poster-design-template-4166448a83bcad7c01288993606a0049_screen.jpg?ts=1719595955"
                     class="w-full rounded-xl">
            </div>

            <div>
                <h3 class="text-2xl font-black uppercase tracking-tight text-white mb-4">NIKE SAPATOSAN</h3>

                <p class="text-sm leading-7 text-white/60 mb-4">
                    Nike is a well-known brand that people like because it feels good to wear and looks stylish at the same time. One of its biggest benefits is comfort because its shoes and clothes are made with lightweight and breathable materials, so they are great for everyday use or sports.
                </p>

                <p class="text-sm leading-7 text-white/60">
                    Another thing people like is performance. Nike shoes are designed with good cushioning and support, which helps when running, walking, or working out. They also last a long time, even if you use them often.
                </p>
            </div>
        </div>
    </div>

    <div class="my-16 text-center">
        <h2 class="text-3xl font-black uppercase tracking-tight text-white md:text-4xl">Layout</h2>
    </div>

    <div class="max-w-6xl mx-auto">

        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-3 shadow-2xl shadow-black/40 transition duration-300 hover:-translate-y-2 hover:border-white/25">
                <img src="https://feetfirstclinic.com/wp-content/uploads/runningshoes1.jpg.webp"
                     class="w-full rounded-xl">
            </div>

            <div>
                <h3 class="text-2xl font-black uppercase tracking-tight text-white mb-4">HOW IT MADE</h3>

                <p class="text-sm leading-7 text-white/60 mb-4">
                    how each section like the toe box, laces, insole, midsole, and outsole helps provide comfort, support, fit, and stability when walking or running.
                </p>

                <p class="text-sm leading-7 text-white/60">
                    the anatomy of a shoe by breaking it down into different parts and explaining the function of each. The upper section includes the toe box, which provides space for the toes to move comfortably, the laces that secure the shoe for a proper fit, and the collar and heel counter that support and stabilize the ankle and heel. The body of the shoe is made from flexible material to adapt to the shape of the foot. Inside, the insole helps distribute pressure evenly.
                </p>
            </div>
            <br>

        </div>

        <div class="text-center my-16">

            <h2 class="text-3xl font-black uppercase tracking-tight text-white mb-8 text-center">AVAILABLE IN:</h2>

            <div class="grid gap-6 sm:grid-cols-2">

                <div class="flex flex-col items-center rounded-2xl border border-white/10 bg-white/[0.04] p-6 transition duration-300 hover:-translate-y-2 hover:border-lime-300/40">
                    <img src="{{ asset('img/online.png') }}" class="w-full h-auto object-contain rounded-xl">
                    <h3 class="mt-4 text-lg font-black uppercase tracking-[0.2em] text-white">ONLINE PLATFORM</h3>
                </div>

                <div class="flex flex-col items-center rounded-2xl border border-white/10 bg-white/[0.04] p-6 transition duration-300 hover:-translate-y-2 hover:border-lime-300/40">
                    <img src="{{ asset('img/store.png') }}" class="w-full h-auto object-contain rounded-xl">
                    <h3 class="mt-4 text-lg font-black uppercase tracking-[0.2em] text-white">PHYSICAL STORES</h3>
                </div>

            </div>

        </div>

        <div class="relative z-10 flex flex-col items-center px-6 text-center">
            <h1 class="text-2xl font-black uppercase tracking-[0.22em] text-white">FOLLOW US ON:</h1>

            <div class="mt-8 flex flex-wrap justify-center gap-5 text-blue-200/70">
                <img src="{{ asset('img/yt.png') }}"
                     alt="YouTube"
                     class="w-24 h-24 md:w-32 md:h-32 rounded-2xl border border-white/10 bg-white/[0.04] p-3 hover:-translate-y-2 transition duration-300 cursor-pointer">
                <img src="{{ asset('img/ig.png') }}"
                     alt="IG"
                     class="w-24 h-24 md:w-32 md:h-32 rounded-2xl border border-white/10 bg-white/[0.04] p-3 hover:-translate-y-2 transition duration-300 cursor-pointer">
                <img src="{{ asset('img/x.png') }}"
                     alt="X"
                     class="w-24 h-24 md:w-32 md:h-32 rounded-2xl border border-white/10 bg-white/[0.04] p-3 hover:-translate-y-2 transition duration-300 cursor-pointer">
            </div>

        </div>

    </div>

</section>

</x-layout>
