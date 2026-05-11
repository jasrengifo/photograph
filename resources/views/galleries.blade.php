<x-public-layout>
    <header class="mb-12 animate-fade-in">
        <div class="flex flex-col items-start gap-4">
            <div class="flex items-center gap-3 text-xs tracking-[0.2em] text-primary uppercase font-bold">
                <div class="h-px w-8 bg-primary"></div>
                <span>Colecciones</span>
            </div>
            <h1 class="font-display text-4xl md:text-5xl lg:text-7xl font-light text-white leading-tight">
                Nuestras <span class="text-gray-500 italic">Galerías</span>
            </h1>
            <p class="text-gray-400 max-w-2xl text-lg font-light leading-relaxed">
                Descubre el mundo a través de mis ojos, organizado por países y momentos únicos.
            </p>
        </div>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-slide-up">
        @forelse($countries as $country)
            <a href="{{ route('gallery', $country->code ?? $country->id) }}" class="group relative aspect-[4/5] overflow-hidden rounded-2xl bg-slate-900 shadow-2xl">
                @php
                    $coverPhoto = $country->photos()->latest()->first();
                @endphp
                @if($coverPhoto)
                    <img src="{{ Storage::url($coverPhoto->image_path) }}" 
                         alt="{{ $country->name }}" 
                         class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                @else
                    <div class="absolute inset-0 h-full w-full bg-slate-800 flex items-center justify-center">
                        <span class="material-symbols-outlined text-slate-700 text-6xl">image_not_supported</span>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 w-full">
                    <span class="text-[10px] font-bold tracking-[0.3em] text-primary uppercase mb-2 block">{{ $country->photos()->count() }} Fotos</span>
                    <h2 class="text-3xl font-display font-light text-white">{{ $country->name }}</h2>
                    <p class="text-slate-400 text-xs mt-2 opacity-0 transform translate-y-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">Explorar galería</p>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-20">
                <p class="text-gray-500 text-xl font-light">No hay galerías disponibles en este momento.</p>
            </div>
        @endforelse
    </div>
</x-public-layout>
