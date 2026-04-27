<x-layout title="Home | E-COMMERCE-SHOE-WEBSITE">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<!-- HERO SECTION -->
<section class="bg-white text-black">

    <div class="max-w-6xl mx-auto py-10 px-6">

        <!-- BIG SHOE IMAGE -->
        <div class="relative flex justify-center">
            <img src="https://ronashoes.com/cdn/shop/collections/Rona-Shoes---Luna-Black.jpg?v=1704060625"
                 class="w-full max-h-[500px] object-contain">
           
        </div>

        <!-- PAGINATION -->
        <div class="flex justify-center mt-6">
            <div class="flex gap-2 bg-black text-white px-4 py-2 rounded-full text-sm">
                <span class="bg-white text-black px-2 rounded">1</span>
                <span>2</span>
                <span>3</span>
                <span>...</span>
                <span>67</span>
                <span>88</span>
            </div>
        </div>

    </div>

</section>


<!-- TRENDING -->
<section class="bg-[url('/img/bgforhome.jpg')] bg-center py-14 px-6 text-white">

    <div class="max-w-6xl mx-auto">

        <h2 class="text-3xl font-bold text-center mb-8 tracking-wide">TRENDING</h2>
        <br>

        <div class="grid md:grid-cols-2 gap-10 items-center">

            <!-- IMAGE -->
            <div class="bg-white p-4 rounded-xl">
                <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/f2392cd9-24ab-4afa-a9b4-ae193d393dba/dfj3rav-e8565e08-45ea-4b22-a5d9-45a76adda15c.jpg/v1/fill/w_894,h_894,q_70,strp/shoe_poster_design_by_sintukumar_dfj3rav-pre.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9MTI4MCIsInBhdGgiOiIvZi9mMjM5MmNkOS0yNGFiLTRhZmEtYTliNC1hZTE5M2QzOTNkYmEvZGZqM3Jhdi1lODU2NWUwOC00NWVhLTRiMjItYTVkOS00NWE3NmFkZGExNWMuanBnIiwid2lkdGgiOiI8PTEyODAifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.6xee7EbH7mOaRAQjYTa07j4eYIaTbOjoBBk8Ts9Q_wc"
                     class="w-full rounded-lg">
            </div>

            <!-- TEXT -->
            <div>
                <h3 class="text-2xl font-bold mb-4">NIKE SAPATOSAN</h3>

                <p class="text-gray-300 text-sm leading-relaxed mb-4">
                    Nike is a well-known brand that people like because it feels good to wear
                    and looks stylish at the same time. One of its biggest benefits is comfort.
                </p>

                <p class="text-gray-300 text-sm leading-relaxed">
                    Another thing people like is performance. Nike shoes are designed with
                    good cushioning and support for running, walking, and training.
                </p>
            </div>
        </div>
    </div>

    <br>
    <h2 class="text-3xl font-bold text-center mb-8 tracking-wide">FEATURES</h2>
    <br>

    <div class="max-w-6xl mx-auto">

        <div class="grid md:grid-cols-2 gap-10 items-center">

            <!-- IMAGE -->
            <div class="bg-white p-4 rounded-xl">
                <img src="https://feetfirstclinic.com/wp-content/uploads/runningshoes1.jpg.webp"
                     class="w-full rounded-lg">
            </div>

            <!-- TEXT -->
            <div>
                <h3 class="text-2xl font-bold mb-4">NIKE SAPATOSAN</h3>

                <p class="text-gray-300 text-sm leading-relaxed mb-4">
                    Nike is a well-known brand that people like because it feels good to wear
                    and looks stylish at the same time. One of its biggest benefits is comfort.
                </p>

                <p class="text-gray-300 text-sm leading-relaxed">
                    Another thing people like is performance. Nike shoes are designed with
                    good cushioning and support for running, walking, and training.
                </p>
            </div>

        </div>

        <div class="flex flex-wrap justify-center gap-6 mb-10">

        <h2 class="text-3xl font-bold text-center mb-8 tracking-wide">AVAILABLE IN:</h2>
            <img src="">
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

</x-layouts>