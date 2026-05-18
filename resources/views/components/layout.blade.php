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

<body class="bg-black text-white font-sans min-h-screen">

<!-- NAVBAR -->
<nav class="flex items-center justify-between px-6 py-4 bg-[#111] border-b border-gray-800">

    <!-- LOGO -->
    <div class="flex items-center gap-3 round hover:scale-105 transition">
        <img src="{{ asset('img/logo.png') }}" class="w-28 rounded-[10px]">
    </div>

    <!-- LINKS -->
    <div class="flex gap-8 text-sm text-gray-300">
    <a href="/home" class="relative group px-3 py-1 rounded transition duration-300">
        HOME
        <span class="absolute left-0 bottom-0 w-0 h-[2px] bg-white transition-all duration-300 ease-in-out group-hover:w-full"></span>
    </a>

    <a href="/products" class="relative group px-3 py-1 rounded transition duration-300">
        PRODUCT
        <span class="absolute left-0 bottom-0 w-0 h-[2px] bg-white transition-all duration-300 ease-in-out group-hover:w-full"></span>
    </a>
</div>

    <div class="flex items-center gap-4 text-sm">
        <div class="flex items-center gap-3">

        <a href="/cart" class="relative inline-block">
    
    <img src="{{ asset('img\shopping.png') }}" 
         alt="cart"
         class="w-9 h-9 opacity-80 cursor-pointer hover:scale-105 transition">

    @if(session('cart') && count(session('cart')) > 0)
        <span class="absolute -top-2 -right-2 
                     bg-red-500 text-white text-[10px] 
                     font-bold rounded-full 
                     w-5 h-5 flex items-center justify-center">
            {{ count(session('cart')) }}
        </span>
    @endif

</a>

            <form method="POST" action="/logout">
                @csrf
    <button type="submit" class="bg-white text-black px-3 py-1 rounded hover:bg-gray-400 transition cursor-pointer font-bold">
        LOG OUT
    </button>
</form>

        </div>
    </div>

</nav>

<!-- PAGE CONTENT -->
<main class="min-h-[calc(100vh-60px)]">
    {{ $slot }}
</main>

</body>
</html>
