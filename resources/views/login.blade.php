<div class="relative min-h-screen flex items-center justify-center overflow-hidden text-white">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <div class="absolute inset-0">
        <video autoplay muted loop playsinline class="w-full h-full object-cover">
            <source src="{{ asset('img\ssstik.io_@lensrdvisuals_1778698610938.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
        </video>

        <div class="absolute inset-0 bg-black/80"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_15%,rgba(190,242,100,0.22),transparent_26%),linear-gradient(135deg,rgba(255,255,255,0.1),transparent_32%)]"></div>
    </div>

    <div class="relative z-10 flex w-full max-w-6xl flex-col items-center px-6 py-10 text-center">

        <div class="mb-7">
            <img src="{{ asset('img/logo.png') }}"
                 alt="Sapatosan Logo"
                 class="w-44 md:w-52 mb-3 rounded-xl ring-1 ring-white/10 drop-shadow-2xl transition duration-300 hover:scale-105">
        </div>

            <div class="mb-8 grid w-full max-w-2xl grid-cols-3 gap-3">

    <img src="https://cdn.dribbble.com/userupload/37582166/file/original-328c8e183460ce0259e957182fe88c19.jpg?resize=420x&vertical=center"
        class="h-52 w-full object-cover rounded-[10px] border border-white/10 opacity-85 shadow-2xl shadow-black/30 transition duration-300 hover:-translate-y-1 hover:opacity-100">

    <img src="{{ asset('img/posterni - Copy.webp') }}"
        class="h-52 w-full object-cover rounded-[10px] border border-white/10 opacity-85 shadow-2xl shadow-black/30 transition duration-300 hover:-translate-y-1 hover:opacity-100">

    <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/sneaker-shoe-poster-design-template-9a8882232bf688b7e9ea3a1978f775e6_screen.jpg?ts=1734163250"
        class="h-52 w-full object-cover rounded-[10px] border border-white/10 opacity-85 shadow-2xl shadow-black/30 transition duration-300 hover:-translate-y-1 hover:opacity-100">

</div>

        <form method="POST" action="/login" class="w-full max-w-md rounded-[2rem] border border-white/10 bg-black/55 p-8 shadow-[0_40px_120px_rgba(0,0,0,0.7)] backdrop-blur-xl transition duration-300 hover:border-white/20">
            @csrf

            <p class="mb-2 text-xs font-bold uppercase tracking-[0.35em] text-lime-300">Member Access</p>
            <h2 class="text-3xl font-black uppercase tracking-tight mb-6">Sign In</h2>

            @if ($errors->has('login'))
                <div class="mb-4 rounded-2xl bg-red-500/20 border border-red-300/30 px-4 py-3 text-sm text-red-100">
                    {{ $errors->first('login') }}
                </div>
            @endif

            <input type="text" required
                name="username"
                value="{{ old('username') }}"
                placeholder="Username"
                class="w-full mb-4 rounded-full border border-white/10 bg-white/[0.06] px-5 py-3 text-white placeholder:text-white/35 transition focus:outline-none focus:border-lime-300/70 focus:bg-white/[0.1]">

            <input type="password" required
                name="password"
                placeholder="Password"
                class="w-full mb-6 rounded-full border border-white/10 bg-white/[0.06] px-5 py-3 text-white placeholder:text-white/35 transition focus:outline-none focus:border-lime-300/70 focus:bg-white/[0.1]">

            <button type="submit" class="w-full rounded-full bg-white py-3 font-black uppercase tracking-[0.22em] text-black transition duration-300 hover:-translate-y-0.5 hover:bg-lime-300">
                Sign In
            </button>

        </form>

         <h1 class="mt-10 text-xs font-black uppercase tracking-[0.35em] text-white/70">FOLLOW US ON:</h1>
        <div class="mt-5 flex flex-wrap justify-center gap-4 text-blue-200/70">
            <img src="{{ asset('img/yt.png') }}"
             alt="YouTube"
             class="w-20 h-20 rounded-2xl border border-white/10 bg-white/[0.04] p-3 transition duration-300 hover:-translate-y-2 cursor-pointer md:w-24 md:h-24">
            <img src="{{ asset('img/ig.png') }}"
             alt="IG"
             class="w-20 h-20 rounded-2xl border border-white/10 bg-white/[0.04] p-3 transition duration-300 hover:-translate-y-2 cursor-pointer md:w-24 md:h-24">
            <img src="{{ asset('img/x.png') }}"
             alt="X"
             class="w-20 h-20 rounded-2xl border border-white/10 bg-white/[0.04] p-3 transition duration-300 hover:-translate-y-2 cursor-pointer md:w-24 md:h-24">
        </div>

    </div>
</div>
