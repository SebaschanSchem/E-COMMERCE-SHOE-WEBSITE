<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="min-h-screen bg-[#050505] text-white flex flex-col font-sans antialiased">

    <header class="relative flex flex-col gap-4 px-6 py-4 bg-black/80 border-b border-white/10 backdrop-blur-xl md:flex-row md:items-center md:justify-between">

    {{-- Logo --}}
    <img src="{{ asset('img/logo.png') }}"
         class="w-28 rounded-xl ring-1 ring-white/10 shadow-2xl shadow-black/40 transition duration-300 hover:scale-105">

    {{-- CENTER NAV --}}
    <nav class="flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] p-1 md:absolute md:left-1/2 md:-translate-x-1/2">

        <a href="/admin/dashboard"
           class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-[0.18em] text-white/60 transition hover:bg-white/10 hover:text-white">
            Dashboard
        </a>

        <a href="/admin/products"
           class="px-4 py-2 rounded-full text-xs font-black uppercase tracking-[0.18em] bg-white text-black shadow-lg">
            Products
        </a>

    </nav>

    {{-- Logout --}}
    <form method="POST" action="/logout">
        @csrf
        <button type="submit"
            class="rounded-full bg-white px-4 py-2 text-xs font-black uppercase tracking-[0.18em] text-black transition duration-300 hover:bg-lime-300 cursor-pointer">
            LOG OUT
        </button>
    </form>

</header>

        {{-- MAIN --}}
        <main class="flex-1 p-6 space-y-6 overflow-y-auto">

            <div>
                <p class="text-xs font-bold uppercase tracking-[0.35em] text-lime-300">Inventory Studio</p>
                <h1 class="mt-2 text-3xl font-black uppercase tracking-tight md:text-5xl">Products</h1>
            </div>

            {{-- STATUS --}}
        @if (session('status'))
    <div
        id="toast-notification"
        class="fixed top-1/2 left-1/2 z-50
               -translate-x-1/2 -translate-y-1/2
               w-[340px] max-w-[90%]
               rounded-2xl border border-red-300/30 bg-green-500 text-white
               px-5 py-4 text-sm text-center
               shadow-2xl shadow-red-500/20
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

            {{-- ADD PRODUCT --}}
            <section class="rounded-2xl border border-white/10 bg-white/[0.04] p-6 shadow-2xl shadow-black/25">

                <h1 class="text-xl font-black uppercase tracking-wide mb-5">Add Product</h1>

                <form method="POST" action="/admin/products" enctype="multipart/form-data"
                      class="grid lg:grid-cols-5 gap-4 items-end">

                    @csrf

                    <div>
                        <label class="text-xs text-white/50 mb-1 block uppercase tracking-[0.2em]">Name</label>
                        <input name="name" value="{{ old('name') }}" required
                               class="w-full rounded-xl border border-white/10 bg-black/50 px-3 py-3 text-sm text-white focus:outline-none focus:border-lime-300/70">
                    </div>

                    <div>
                        <label class="text-xs text-white/50 mb-1 block uppercase tracking-[0.2em]">Price</label>
                        <input name="price" type="number" step="0.01" value="{{ old('price') }}" required
                               class="w-full rounded-xl border border-white/10 bg-black/50 px-3 py-3 text-sm text-white focus:outline-none focus:border-lime-300/70">
                    </div>

                    <div>
                        <label class="text-xs text-white/50 mb-1 block uppercase tracking-[0.2em]">Category</label>
                        <input name="category" value="{{ old('category') }}" required
                               class="w-full rounded-xl border border-white/10 bg-black/50 px-3 py-3 text-sm text-white focus:outline-none focus:border-lime-300/70">
                    </div>

                    <div>
                        <label class="text-xs text-white/50 mb-1 block uppercase tracking-[0.2em]">Stock</label>
                        <input name="stock" type="number" value="{{ old('stock') }}" required
                               class="w-full rounded-xl border border-white/10 bg-black/50 px-3 py-3 text-sm text-white focus:outline-none focus:border-lime-300/70">
                    </div>

                    <div>
                        <label class="text-xs text-white/50 mb-1 block uppercase tracking-[0.2em]">Image</label>

                        <label class="flex h-24 cursor-pointer items-center justify-center rounded-xl border border-dashed border-white/20 bg-black/50 text-xs font-bold uppercase tracking-[0.16em] text-white/60 transition hover:border-lime-300/70 hover:text-lime-300">
                            <span data-file-label>Upload Image</span>
                            <input name="image" type="file" accept="image/*" class="hidden" required>
                        </label>
                    </div>

                    <button class="rounded-full bg-white px-5 py-3 text-xs font-black uppercase tracking-[0.2em] text-black transition duration-300 hover:bg-lime-300">
                        Add Product
                    </button>

                </form>

                @if ($errors->any())
                    <div class="mt-4 text-sm text-red-400">
                        {{ $errors->first() }}
                    </div>
                @endif

            </section>

            {{-- PRODUCTS --}}
            <section class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">

                @foreach ($products as $product)

                    @php
                        $image = str_starts_with($product->image, 'http')
                            ? $product->image
                            : asset($product->image);
                    @endphp

                    <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-4 shadow-2xl shadow-black/25 transition duration-300 hover:-translate-y-1 hover:border-lime-300/40">

                        <div class="h-40 bg-gradient-to-br from-white via-zinc-100 to-zinc-300 rounded-xl flex items-center justify-center mb-4 overflow-hidden">
                            <img src="{{ $image }}" class="w-full h-full object-contain p-3">
                        </div>

                        {{-- UPDATE --}}
                        <form method="POST" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data" class="space-y-3">
                            @csrf
                            @method('PUT')

                            <input name="name" value="{{ $product->name }}"
                                   class="w-full rounded-xl border border-white/10 bg-black/50 px-3 py-3 text-sm text-white focus:outline-none focus:border-lime-300/70">

                            <div class="grid grid-cols-3 gap-2">

                                <input name="price" type="number" value="{{ $product->price }}"
                                       class="min-w-0 rounded-xl border border-white/10 bg-black/50 px-2 py-3 text-sm text-white focus:outline-none focus:border-lime-300/70">

                                <input name="category" value="{{ $product->category }}"
                                       class="min-w-0 rounded-xl border border-white/10 bg-black/50 px-2 py-3 text-sm text-white focus:outline-none focus:border-lime-300/70">

                                <input name="stock" type="number" value="{{ $product->stock }}"
                                       class="min-w-0 rounded-xl border border-white/10 bg-black/50 px-2 py-3 text-sm text-white focus:outline-none focus:border-lime-300/70">

                            </div>

                            <label class="flex cursor-pointer items-center justify-center rounded-xl border border-dashed border-white/15 bg-black/40 px-3 py-3 text-[10px] font-bold uppercase tracking-[0.16em] text-white/50 transition hover:border-lime-300/60 hover:text-lime-300">
                                <span data-file-label>Change Image</span>
                                <input name="image" type="file" accept="image/*" class="hidden">
                            </label>

                            <button class="w-full rounded-full bg-white py-3 text-xs font-black uppercase tracking-[0.2em] text-black transition duration-300 hover:bg-lime-300">
                                UPDATE
                            </button>

                        </form>

                        {{-- DELETE --}}
                        <form method="POST" action="/admin/products/{{ $product->id }}" class="mt-2">
                            @csrf
                            @method('DELETE')

                            <button class="w-full rounded-full border border-red-500/40 py-3 text-xs font-black uppercase tracking-[0.2em] text-red-300 transition hover:bg-red-500 hover:text-white">
                                DELETE
                            </button>

                        </form>

                    </div>

                @endforeach

            </section>

        </main>
    </div>

<script>
    document.querySelectorAll('input[type="file"]').forEach((input) => {
        input.addEventListener('change', () => {
            const label = input.closest('label')?.querySelector('[data-file-label]');

            if (label) {
                label.textContent = input.files?.[0]?.name || 'Upload Image';
            }
        });
    });
</script>
