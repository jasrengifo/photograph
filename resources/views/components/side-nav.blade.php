<nav x-data="{ mobileMenuOpen: false }"
    class="flex-none w-full md:w-80 h-auto md:h-full bg-[#121118] border-b md:border-b-0 md:border-r border-white/5 flex flex-col justify-between z-50 relative shadow-2xl">
    
    <!-- Mobile Header Bar -->
    <div class="md:hidden flex items-center justify-between px-6 py-4 bg-[#121118] border-b border-white/5 relative z-50">
        <div class="flex items-center gap-3">
            <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 ring-2 ring-white/10"
                style="background-image: url('{{ Storage::url('photos/ruthg.jpg') }}');">
            </div>
            <h1 class="text-white text-base font-bold tracking-wide">SouLens</h1>
        </div>
        
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white p-2 hover:bg-white/5 rounded-lg transition-colors">
            <span class="material-symbols-outlined" x-text="mobileMenuOpen ? 'close' : 'menu'">menu</span>
        </button>
    </div>

    <!-- Sidebar Content (Hidden on mobile by default) -->
    <div :class="mobileMenuOpen ? 'flex' : 'hidden md:flex'" class="flex-col h-full justify-between overflow-hidden">
        <div class="flex flex-col p-8 overflow-y-auto no-scrollbar">
            <!-- Logo Section (Desktop only) -->
            <div class="hidden md:flex flex-col gap-4 mb-10">
                <div class="flex items-center gap-4">
                    <div class="bg-center bg-no-repeat bg-cover rounded-full size-12 ring-2 ring-white/10"
                        style="background-image: url('{{ Storage::url('photos/ruthg.jpg') }}');">
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-white text-lg font-bold tracking-wide leading-tight">SouLens</h1>
                        <p class="text-slate-400 text-xs font-medium tracking-widest uppercase mt-1">Visual Artist</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <a href="{{ route('home') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-lg {{ request()->routeIs('home') ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-slate-400 hover:text-white' }} transition-all duration-300 group">
                    <span class="material-symbols-outlined group-hover:scale-110 transition-transform">home</span>
                    <p class="text-sm font-semibold tracking-wide">Home</p>
                </a>

                <details class="group rounded-lg transition-colors duration-300" {{ request()->routeIs('gallery*') ? 'open' : '' }}>
                    <summary
                        class="flex cursor-pointer items-center justify-between gap-4 px-4 py-3 rounded-lg bg-white/5 text-white transition-colors duration-300 select-none">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined">photo_library</span>
                            <p class="text-sm font-medium tracking-wide">Galleries</p>
                        </div>
                        <span
                            class="material-symbols-outlined text-slate-500 text-lg transition-transform duration-300 group-open:rotate-180">expand_more</span>
                    </summary>

                    <div class="flex flex-col pl-12 pr-2 pb-2 gap-1 mt-1 border-l border-white/5 ml-6">
                        @foreach(\App\Models\Country::where('active', true)->has('photos')->get() as $country)
                            <a href="{{ route('gallery', $country->code ?? $country->id) }}"
                                class="px-3 py-2 rounded-md hover:bg-white/5 text-slate-400 hover:text-white text-sm transition-colors flex justify-between items-center group/item {{ request()->is('gallery/' . ($country->code ?? $country->id)) ? 'bg-primary/10 text-white border-l-2 border-primary' : '' }}">
                                <span>{{ $country->name }}</span>
                                <span
                                    class="material-symbols-outlined text-[10px] {{ request()->is('gallery/' . ($country->code ?? $country->id)) ? 'text-primary' : 'opacity-0 group-hover/item:opacity-100' }} transition-opacity">arrow_forward</span>
                            </a>
                        @endforeach
                    </div>
                </details>

                <a href="{{ route('about') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-lg {{ request()->routeIs('about') ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-slate-400 hover:text-white' }} transition-all duration-300 group">
                    <span
                        class="material-symbols-outlined text-slate-400 group-hover:text-white transition-colors">person</span>
                    <p class="text-slate-300 text-sm font-medium tracking-wide group-hover:text-white transition-colors">
                        Sobre mi</p>
                </a>
                <a href="{{ route('contact') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-lg {{ request()->routeIs('contact') ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-slate-400 hover:text-white' }} transition-all duration-300 group">
                    <span
                        class="material-symbols-outlined text-slate-400 group-hover:text-white transition-colors">mail</span>
                    <p class="text-slate-300 text-sm font-medium tracking-wide group-hover:text-white transition-colors">
                        Contactame</p>
                </a>
            </div>
        </div>

        <!-- Footer/Socials -->
        <div class="p-8 border-t border-white/5 bg-[#121118]">
            @auth
                <a href="{{ route('admin.photos.index') }}"
                    class="w-full flex items-center justify-center gap-2 rounded-lg h-12 bg-primary hover:bg-primary/90 text-white text-sm font-bold tracking-wide transition-all shadow-lg shadow-primary/25 mb-8 group">
                    <span>Dashboard</span>
                    <span
                        class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform">dashboard</span>
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="w-full flex items-center justify-center gap-2 rounded-lg h-12 bg-primary hover:bg-primary/90 text-white text-sm font-bold tracking-wide transition-all shadow-lg shadow-primary/25 mb-8 group">
                    <span>Login</span>
                    <span
                        class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform">login</span>
                </a>
            @endauth
            <div class="flex justify-between items-center px-2">
                <a href="#" title="Instagram" class="text-slate-500 hover:text-white transition-colors">
                    <span class="material-symbols-outlined">photo_camera</span>
                </a>
            </div>
            <p class="text-center text-slate-600 text-[10px] mt-6 tracking-wider">© {{ date('Y') }} SOULENS</p>
        </div>
    </div>
</nav>