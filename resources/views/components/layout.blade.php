@props([
    'title' => 'Sapatosan',
])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#050505] text-white font-sans min-h-screen antialiased">

<!-- NAVBAR -->
<nav class="sticky top-0 z-40 flex items-center justify-between gap-4 px-4 py-4 md:px-8 bg-black/85 border-b border-white/10 backdrop-blur-xl shadow-[0_18px_60px_rgba(0,0,0,0.45)]">

    <!-- LOGO -->
    <div class="flex items-center gap-3 hover:scale-[1.03] transition duration-300">
        <img src="{{ asset('img/logo.png') }}" class="w-24 md:w-28 rounded-lg ring-1 ring-white/10 shadow-2xl shadow-black/40">
    </div>

    <!-- LINKS -->
    <div class="hidden sm:flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] p-1 text-xs font-semibold uppercase tracking-[0.22em] text-white/60">
    <a href="/home" class="relative group px-4 py-2 rounded-full transition duration-300 hover:bg-white hover:text-black">
        HOME
        <span class="absolute left-1/2 bottom-1 h-[2px] w-0 -translate-x-1/2 bg-black transition-all duration-300 ease-in-out group-hover:w-1/2"></span>
    </a>

    <a href="/products" class="relative group px-4 py-2 rounded-full transition duration-300 hover:bg-white hover:text-black">
        PRODUCT
        <span class="absolute left-1/2 bottom-1 h-[2px] w-0 -translate-x-1/2 bg-black transition-all duration-300 ease-in-out group-hover:w-1/2"></span>
    </a>
</div>

    <div class="flex items-center gap-3 text-sm">
        <div class="flex items-center gap-3">

        <a href="/cart" class="relative inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/10 bg-white/[0.04] shadow-lg shadow-black/30 transition duration-300 hover:-translate-y-0.5 hover:border-white/30 hover:bg-white/10">
    
    <img src="{{ asset('img\shopping.png') }}" 
         alt="cart"
         class="w-7 h-7 opacity-90 cursor-pointer transition">

    @if(session('cart') && count(session('cart')) > 0)
        <span class="absolute -top-2 -right-2 
                     bg-red-500 text-white text-[10px]
                     font-bold rounded-full ring-2 ring-black
                     w-5 h-5 flex items-center justify-center shadow-lg">
            {{ count(session('cart')) }}
        </span>
    @endif

</a>

            <form method="POST" action="/logout">
                @csrf
    <button type="submit" class="rounded-full bg-white px-4 py-2 text-xs font-black uppercase tracking-[0.18em] text-black shadow-lg shadow-white/10 transition duration-300 hover:-translate-y-0.5 hover:bg-lime-300 cursor-pointer">
        LOG OUT
    </button>
</form>

        </div>
    </div>

</nav>

<!-- PAGE CONTENT -->
<main class="min-h-[calc(100vh-76px)]">
    {{ $slot }}
</main>

</body>
</html>
