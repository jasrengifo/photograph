<x-public-layout>
    <header class="mb-12 animate-fade-in">
        <div class="flex flex-col items-start gap-4">
            <div class="flex items-center gap-3 text-xs tracking-[0.2em] text-primary uppercase font-bold">
                <div class="h-px w-8 bg-primary"></div>
                <span>Feed</span>
            </div>
            <h1 class="font-display text-4xl md:text-5xl lg:text-7xl font-light text-white leading-tight">
                Últimos <span class="text-gray-500 italic">Instantes</span>
            </h1>
            <p class="text-gray-400 max-w-2xl text-lg font-light leading-relaxed">
                Explora las capturas más recientes de mi viaje visual.
            </p>
        </div>
    </header>

    <div class="columns-1 md:columns-2 lg:columns-3 xl:columns-4 gap-6 space-y-6 animate-slide-up">
        @forelse($photos as $photo)
            <div class="break-inside-avoid">
                <x-photo-card :photo="$photo" :index="$loop->index" />
            </div>
        @empty
            <div class="col-span-full text-center py-20">
                <p class="text-gray-500 text-xl font-light">Aún no hay fotos publicadas.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $photos->links() }}
    </div>
</x-public-layout>
