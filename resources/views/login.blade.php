<div class="relative min-h-screen flex items-center justify-center overflow-hidden text-white">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <div class="absolute inset-0">
        <video autoplay muted loop playsinline class="w-full h-full object-cover">
            <source src="{{ asset('img\ssstik.io_@lensrdvisuals_1778698610938.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
        </video>

        <div class="absolute inset-0 bg-gradient-to-br from-black/80 via-black/70 to-black/90"></div>
    </div>

    <div class="relative z-10 flex flex-col items-center px-6 text-center">

        <div class="mb-8">
            <img src="{{ asset('img/logo.png') }}"
                 alt="Sapatosan Logo"
                 class="w-54 md:w-42 mb-3 rounded-[10px] drop-shadow-xl hover:scale-105 transition">
        </div>

        <div class="flex flex-wrap justify-center gap-6 mb-10">

        <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/eaa5ef128327031.61540e7a31630.jpg"
            class="w-40 object-contain rounded-[10px] hover:scale-105 transition">

        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRQva76HBW34Ok8im3twNYpSAxPs2c_96Ssg&s"
            class="w-40 object-contain rounded-[10px] hover:scale-105 transition">

        <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/sneaker-shoe-poster-design-template-9a8882232bf688b7e9ea3a1978f775e6_screen.jpg?ts=1734163250"
            class="w-40 object-contain rounded-[10px] hover:scale-105 transition">

        </div>

        <form method="POST" action="/login" class="w-full max-w-md p-8 rounded-3xl bg-white/10 border border-white/10 shadow-2xl backdrop-blur-md hover:bg-white/20 transition">
            @csrf

            <h2 class="text-2xl font-bold mb-6">Sign In</h2>

            @if ($errors->has('login'))
                <div class="mb-4 rounded-xl bg-red-500/20 border border-red-300/30 px-4 py-3 text-sm text-red-100">
                    {{ $errors->first('login') }}
                </div>
            @endif

            <input type="text" required
                name="username"
                value="{{ old('username') }}"
                placeholder="Username"
                class="w-full mb-4 px-4 py-3 bg-black/60 border border-white/10 rounded-xl focus:outline-none focus:border-amber-400 transition">

            <input type="password" required
                name="password"
                placeholder="Password"
                class="w-full mb-6 px-4 py-3 bg-black/60 border border-white/10 rounded-xl focus:outline-none focus:border-amber-400 transition">

            <button type="submit" class="w-full bg-amber-400 text-black py-3 rounded-xl font-bold hover:bg-amber-500 transition">
                Sign In
            </button>

        </form>

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
</div>
