@props([
    'title' => 'Sapatosan',
])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

</head>

<body class="bg-black text-white font-sans min-h-screen">

<!-- NAVBAR -->
<nav class="flex items-center justify-between px-6 py-4 bg-[#111] border-b border-gray-800">

    <!-- LOGO -->
    <div class="flex items-center gap-3 round ">
        <img src="{{ asset('img/logo.png') }}" class="w-28 rounded-[10px]">
    </div>

    <!-- LINKS -->
    <div class="flex gap-8 text-sm text-gray-300">
        <a href="/home" class="hover:text-white transition">HOME</a>
        <a href="/product" class="hover:text-white transition">PRODUCT</a>
        <a href="/purchase" class="hover:text-white transition">PURCHASE</a>
    </div>

    <!-- USER -->
    <div class="flex items-center gap-4 text-sm">
        <div class="flex items-center gap-3">

            <a href="/addtocart">
    <img src="{{ asset('img/shopping-cart.png') }}" alt="cart"
         class="w-6 h-6 opacity-80 cursor-pointer">
</a>

            <a href="/login">
    <button class="bg-white text-black px-3 py-1 rounded hover:bg-gray-200 transition">
        LOG OUT
    </button>
</a>

        </div>
    </div>

</nav>

<!-- PAGE CONTENT -->
<main class="min-h-[calc(100vh-60px)]">
    {{ $slot }}
</main>

</body>
</html>