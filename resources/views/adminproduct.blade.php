<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="min-h-screen bg-[#13132a] font-sans flex flex-col text-white">
    <header class="flex items-center justify-between px-5 py-3 bg-[#22223b] border-b border-[#33335a]">
        <div class="flex items-center gap-3">
            <img src="{{ asset('img/logo.png') }}" class="w-28 rounded-[10px]">
        </div>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="text-sm text-white/70 hover:text-white transition">Log Out</button>
        </form>
    </header>

    <div class="flex flex-1">
        <aside class="w-52 shrink-0 bg-[#22223b] border-r border-[#33335a] flex flex-col py-4">
            <nav class="flex flex-col gap-1 px-2">
                <a href="/admin/dashboard" class="px-3 py-2.5 rounded-lg text-sm text-white/50 hover:bg-white/5 hover:text-white transition">Dashboard</a>
                <a href="/admin/products" class="px-3 py-2.5 rounded-lg text-sm font-medium text-indigo-300 bg-indigo-500/10 border-l-2 border-indigo-500 transition">Product</a>
            </nav>
        </aside>

        <main class="flex-1 p-6 space-y-6">
            @if (session('status'))
                <div class="rounded-lg bg-green-500/20 border border-green-300/30 px-4 py-3 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <section class="bg-[#22223b] border border-[#33335a] rounded-2xl p-6">
                <h1 class="text-xl font-bold mb-4">Add Product</h1>
                <form method="POST" action="/admin/products" enctype="multipart/form-data" class="grid lg:grid-cols-5 gap-4 items-end">
                    @csrf
                    <div>
                        <label class="block text-xs text-white/50 mb-1">Name</label>
                        <input name="name" class="w-full bg-[#2a2a45] border border-[#33335a] rounded-lg px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs text-white/50 mb-1">Price</label>
                        <input name="price" type="number" step="0.01" min="0" class="w-full bg-[#2a2a45] border border-[#33335a] rounded-lg px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs text-white/50 mb-1">Category</label>
                        <input name="category" placeholder="sneakers, running, casual" class="w-full bg-[#2a2a45] border border-[#33335a] rounded-lg px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs text-white/50 mb-1">Stock</label>
                        <input name="stock" type="number" min="0" class="w-full bg-[#2a2a45] border border-[#33335a] rounded-lg px-3 py-2 text-sm" required>
                    </div>
                    <div class="lg:row-span-2">
                        <label class="block text-xs text-white/50 mb-1">Image Upload</label>
                        <label class="drop-zone flex h-28 cursor-pointer items-center justify-center rounded-lg border border-dashed border-indigo-300/50 bg-[#2a2a45] px-3 text-center text-xs text-white/60 hover:border-indigo-300">
                            <span>Drag image here or click</span>
                            <input name="image" type="file" accept="image/*" class="hidden image-input" required>
                        </label>
                    </div>
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                        Add Product
                    </button>
                </form>
                @if ($errors->any())
                    <div class="mt-4 text-sm text-red-200">
                        {{ $errors->first() }}
                    </div>
                @endif
            </section>

            <section>
                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        @php
                            $image = str_starts_with($product->image, 'http') ? $product->image : asset($product->image);
                        @endphp

                        <div class="bg-[#22223b] border border-[#33335a] p-4 rounded-xl hover:border-indigo-500/50 transition">
                            <div class="bg-[#2a2a45] h-40 flex items-center justify-center mb-3 rounded-lg overflow-hidden">
                                <img src="{{ $image }}" alt="{{ $product->name }}" class="w-full h-full object-contain rounded-[10px]">
                            </div>

                            <form method="POST" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                @method('PUT')

                                <input name="name" value="{{ $product->name }}" class="w-full bg-[#2a2a45] border border-[#33335a] rounded-lg px-3 py-2 text-sm">
                                <div class="grid grid-cols-3 gap-2">
                                    <input name="price" type="number" step="0.01" min="0" value="{{ $product->price }}" class="bg-[#2a2a45] border border-[#33335a] rounded-lg px-3 py-2 text-sm">
                                    <input name="category" value="{{ $product->category }}" class="bg-[#2a2a45] border border-[#33335a] rounded-lg px-3 py-2 text-sm">
                                    <input name="stock" type="number" min="0" value="{{ $product->stock }}" class="bg-[#2a2a45] border border-[#33335a] rounded-lg px-3 py-2 text-sm">
                                </div>

                                <label class="drop-zone flex h-20 cursor-pointer items-center justify-center rounded-lg border border-dashed border-white/20 bg-[#2a2a45] px-3 text-center text-xs text-white/50 hover:border-indigo-300">
                                    <span>Drop replacement image or click</span>
                                    <input name="image" type="file" accept="image/*" class="hidden image-input">
                                </label>

                                <div class="flex gap-2">
                                    <button type="submit" class="flex-1 bg-white text-black rounded-lg py-2 text-sm font-bold hover:bg-gray-200">Edit</button>
                                </div>
                            </form>

                            <form method="POST" action="/admin/products/{{ $product->id }}" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full border border-red-300/40 text-red-200 rounded-lg py-2 text-sm hover:bg-red-500 hover:text-white transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
</div>

<script>
    document.querySelectorAll('.drop-zone').forEach((zone) => {
        const input = zone.querySelector('.image-input');
        const label = zone.querySelector('span');

        zone.addEventListener('dragover', (event) => {
            event.preventDefault();
            zone.classList.add('border-indigo-300');
        });

        zone.addEventListener('dragleave', () => zone.classList.remove('border-indigo-300'));

        zone.addEventListener('drop', (event) => {
            event.preventDefault();
            zone.classList.remove('border-indigo-300');
            input.files = event.dataTransfer.files;
            label.textContent = input.files[0]?.name || label.textContent;
        });

        input.addEventListener('change', () => {
            label.textContent = input.files[0]?.name || label.textContent;
        });
    });
</script>
