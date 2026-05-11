<x-public-layout mainClasses="p-0 overflow-hidden">
    <div class="relative w-full h-full flex flex-col justify-center items-center overflow-hidden bg-black">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0 select-none">
            @php
                $featuredPhoto = \App\Models\Photo::where('is_featured', true)->latest()->first();
                // Check if specialized home image exists, otherwise fallback to featured or unsplash
                $bgImage = Storage::url('photos/verticalhome.jpg');
            @endphp
            <img src="{{ $bgImage }}" alt="Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 z-10" style="background-color: rgba(20, 17, 33, 0.70);"></div>
            <!-- Theme bg color #141121 with 85% opacity -->
        </div>

        <!-- content -->
        <div class="relative z-20 text-center px-6 max-w-5xl mx-auto flex flex-col items-center gap-8 animate-slide-up">
            <!-- Subtitle -->
            <div class="flex items-center gap-4 text-white uppercase tracking-[0.4em] text-[10px] md:text-xs font-bold">
                <div class="h-px w-8 md:w-16 bg-white/60"></div>
                <span>{{ \App\Models\Setting::where('key', 'home_subtitle')->value('value') ?? 'Selected Works ' . date('Y') }}</span>
                <div class="h-px w-8 md:w-16 bg-white/60"></div>
            </div>

            <!-- Title -->
            <div class="flex flex-col items-center leading-none">
                <span
                    class="text-5xl md:text-7xl lg:text-9xl font-bold tracking-tight font-display text-white mb-[-0.1em]">
                    {{ \App\Models\Setting::where('key', 'home_title_1')->value('value') ?? 'Capturando' }}
                </span>
                <span class="text-4xl md:text-6xl lg:text-8xl font-light italic font-display text-white">
                    {{ \App\Models\Setting::where('key', 'home_title_2')->value('value') ?? 'Lo Invisible' }}
                </span>
            </div>

            <!-- Description -->
            <p
                class="text-slate-300 text-sm md:text-lg font-light leading-relaxed max-w-lg md:max-w-2xl mx-auto mt-4 mix-blend-screen">
                {{ \App\Models\Setting::where('key', 'home_description')->value('value') ?? 'Explorando los límites entre la luz y la sombra a través de los paisajes de Sudamérica y Europa.' }}
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mt-8">
                <a href="{{ route('galleries') }}"
                    class="px-8 py-3 bg-white text-black text-[10px] md:text-xs font-bold tracking-[0.2em] uppercase rounded-sm hover:bg-slate-200 transition-colors">
                    Ver Galerías
                </a>
                <a href="{{ route('latest') }}"
                    class="px-8 py-3 border border-white/20 text-white text-[10px] md:text-xs font-bold tracking-[0.2em] uppercase rounded-sm hover:bg-white/10 transition-colors">
                    Últimos posts
                </a>
            </div>
        </div>

        <!-- Badge (Bottom Right or Top Right - Repositioned to avoid center) -->
        <div class="absolute bottom-8 right-8 z-20 hidden md:block">
            <div class="flex items-center gap-2 text-white/60">
                <span class="material-symbols-outlined text-sm">location_on</span>
                <span class="text-[10px] font-bold tracking-widest uppercase">
                    {{ $featuredPhoto ? ($featuredPhoto->country->name ?? 'Location') : 'Andes Mountains' }}
                </span>
            </div>
        </div>
    </div>
</x-public-layout>