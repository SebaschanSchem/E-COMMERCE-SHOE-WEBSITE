<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="min-h-screen bg-[#0f1117] text-white flex flex-col font-sans">

    {{-- HEADER --}}
    <header class="flex items-center justify-between px-6 py-4 bg-[#151823] border-b border-white/5">

        <img src="{{ asset('img/logo.png') }}" class="w-28 rounded-lg">

        <form method="POST" action="/logout">
            @csrf
            <button class="text-sm text-white/60 hover:text-white transition bgwhite/10 px-3 py-1 rounded">
                Log Out
            </button>
        </form>

    </header>

    <div class="flex flex-1">

        {{-- SIDEBAR --}}
        <aside class="w-56 bg-[#151823] border-r border-white/5 py-4">

            <nav class="flex flex-col gap-2 px-3">

                <a href="/admin/dashboard"
                   class="px-3 py-2 rounded-lg text-sm text-white/60 hover:text-white hover:bg-white/5 transition">
                    Dashboard
                </a>

                <a href="/admin/products"
                   class="px-3 py-2 rounded-lg text-sm bg-white/10 text-white border border-white/10">
                    Products
                </a>

            </nav>

        </aside>

        {{-- MAIN --}}
        <main class="flex-1 p-6 space-y-6 overflow-y-auto">

            {{-- STATUS --}}
            @if (session('status'))
                <div class="rounded-lg bg-white/5 border border-white/10 px-4 py-3 text-sm text-white">
                    {{ session('status') }}
                </div>
            @endif

            {{-- ADD PRODUCT --}}
            <section class="bg-[#151823] border border-white/5 rounded-2xl p-6">

                <h1 class="text-xl font-bold mb-5">Add Product</h1>

                <form method="POST" action="/admin/products" enctype="multipart/form-data"
                      class="grid lg:grid-cols-5 gap-4 items-end">

                    @csrf

                    <div>
                        <label class="text-xs text-white/50 mb-1 block">Name</label>
                        <input name="name" required
                               class="w-full bg-[#0f1117] border border-white/10 rounded-lg px-3 py-2 text-sm text-white">
                    </div>

                    <div>
                        <label class="text-xs text-white/50 mb-1 block">Price</label>
                        <input name="price" type="number" step="0.01" required
                               class="w-full bg-[#0f1117] border border-white/10 rounded-lg px-3 py-2 text-sm text-white">
                    </div>

                    <div>
                        <label class="text-xs text-white/50 mb-1 block">Category</label>
                        <input name="category" required
                               class="w-full bg-[#0f1117] border border-white/10 rounded-lg px-3 py-2 text-sm text-white">
                    </div>

                    <div>
                        <label class="text-xs text-white/50 mb-1 block">Stock</label>
                        <input name="stock" type="number" required
                               class="w-full bg-[#0f1117] border border-white/10 rounded-lg px-3 py-2 text-sm text-white">
                    </div>

                    <div>
                        <label class="text-xs text-white/50 mb-1 block">Image</label>

                        <label class="flex h-24 cursor-pointer items-center justify-center rounded-lg border border-dashed border-white/20 bg-[#0f1117] text-xs text-white/60 hover:border-white/40 transition">
                            Upload Image
                            <input name="image" type="file" class="hidden" required>
                        </label>
                    </div>

                    <button class="bg-white text-black font-bold rounded-lg px-4 py-2 hover:bg-gray-200 transition">
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

                    <div class="bg-[#151823] border border-white/5 rounded-2xl p-4 hover:border-white/20 transition">

                        <div class="h-40 bg-[#0f1117] border border-white/10 rounded-lg flex items-center justify-center mb-3">
                            <img src="{{ $image }}" class="w-full h-full object-contain">
                        </div>

                        {{-- UPDATE --}}
                        <form method="POST" action="/admin/products/{{ $product->id }}" class="space-y-3">
                            @csrf
                            @method('PUT')

                            <input name="name" value="{{ $product->name }}"
                                   class="w-full bg-[#0f1117] border border-white/10 rounded-lg px-3 py-2 text-sm text-white">

                            <div class="grid grid-cols-3 gap-2">

                                <input name="price" type="number" value="{{ $product->price }}"
                                       class="bg-[#0f1117] border border-white/10 rounded-lg px-2 py-2 text-sm text-white">

                                <input name="category" value="{{ $product->category }}"
                                       class="bg-[#0f1117] border border-white/10 rounded-lg px-2 py-2 text-sm text-white">

                                <input name="stock" type="number" value="{{ $product->stock }}"
                                       class="bg-[#0f1117] border border-white/10 rounded-lg px-2 py-2 text-sm text-white">

                            </div>

                            <button class="w-full bg-white text-black py-2 rounded-lg text-sm font-bold hover:bg-gray-200">
                                UPDATE
                            </button>

                        </form>

                        {{-- DELETE --}}
                        <form method="POST" action="/admin/products/{{ $product->id }}" class="mt-2">
                            @csrf
                            @method('DELETE')

                            <button class="w-full border border-red-500/40 text-red-400 rounded-lg py-2 text-sm hover:bg-red-500 hover:text-white transition">
                                DELETE
                            </button>

                        </form>

                    </div>

                @endforeach

            </section>

        </main>
    </div>
</div>