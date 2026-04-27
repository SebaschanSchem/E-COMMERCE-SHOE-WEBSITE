    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <div class="min-h-screen bg-[#13132a] font-sans flex flex-col">

        <!-- ─── TOP NAVBAR ─────────────────────────────────────────────── -->
        <header class="flex items-center justify-between px-5 py-3 bg-[#22223b] border-b border-[#33335a]">

            <!-- Brand -->
            <div class="flex items-center gap-3 round ">
        <img src="{{ asset('img/logo.png') }}" class="w-28 rounded-[10px]">
    </div>

            <!-- Right side -->
            <div class="flex items-center gap-4">

                <!-- Search -->
                <div class="relative hidden sm:flex items-center">
                    <input type="text" placeholder="Search"
                        class="bg-[#2a2a45] border border-[#33335a] text-sm text-white/70 placeholder-white/30 rounded-lg px-3 py-1.5 pr-8 w-40 focus:outline-none focus:border-indigo-400 transition" />
                    <svg class="absolute right-2.5 w-3.5 h-3.5 text-white/30" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                </div>
                
                <!-- User dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 text-sm text-white/70 hover:text-white transition">
                        <div class="w-7 h-7 rounded-full bg-indigo-500 flex items-center justify-center text-xs font-bold text-white">U</div>
                    </button>

            </div>
        </header>

        <!-- ─── BODY ───────────────────────────────────────────────────── -->
        <div class="flex flex-1">

            <!-- ─── SIDEBAR ────────────────────────────────────────────── -->
            <aside class="w-52 shrink-0 bg-[#22223b] border-r border-[#33335a] flex flex-col py-4">

                <nav class="flex flex-col gap-1 px-2">

                    <a href="/admindashboard" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium text-white/50 hover:bg-white/5 hover:text-white transition">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 0 0 1 1h3m10-11l2 2m-2-2v10a1 1 0 0 1-1 1h-3m-4 0h4"/>
                            </svg>
                            Home
                        </div>
                        <svg class="w-3.5 h-3.5 text-white/20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>

                    <a href="/adminproduct" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium text-indigo-300 bg-indigo-500/10 border-l-2 border-indigo-500 transition">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2m14 0V9a2 2 0 0 0-2-2M5 11V9a2 2 0 0 1 2-2m0 0h10M7 7V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2"/>
                            </svg>
                        Product
                        </div>
                        <svg class="w-3.5 h-3.5 text-white/20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>

                    <a href="/" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm text-white/50 hover:bg-white/5 hover:text-white transition">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            Log Out
                        </div>
                        <svg class="w-3.5 h-3.5 text-white/20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>

                </nav>

            </aside>

            <!-- ─── MAIN CONTENT ───────────────────────────────────────── -->
            <main class="flex-1 p-6">

            <div class="flex justify-end mb-4">
        <a href="/adminproduct/create"
            class="bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            + Add Product
        </a>
    </div>

                <div class="grid grid-cols-3 gap-6">

                    <!-- Product Card -->
                    @for ($i = 0; $i < 9; $i++)
                    <div class="bg-[#22223b] border border-[#33335a] p-3 rounded-xl hover:scale-105 hover:border-indigo-500/50 transition">

                        <div class="bg-[#2a2a45] h-32 flex items-center justify-center mb-3 rounded-lg">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTldU2qEuHP-kuO_ufDLpZQmhY-ikI5KDaBzg&s" class="h-20 object-contain rounded-[10px]">
                        </div>

                        <h3 class="text-white text-sm font-semibold">Running Shoe</h3>
                        <p class="text-white/40 text-xs mt-0.5">Comfort wear</p>

                        <div class="mt-2 text-indigo-400 text-sm font-bold">$120.00</div>

                    </div>
                    @endfor

                </div>
            </main>

        </div>

    </div>