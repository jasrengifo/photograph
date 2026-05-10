<x-public-layout>
    <header class="mb-12 animate-fade-in">
        <div class="flex flex-col items-start gap-4">
            <div class="flex items-center gap-3 text-xs tracking-[0.2em] text-primary uppercase font-bold">
                <div class="h-px w-8 bg-primary"></div>
                <span>{{ $country->name }}</span>
            </div>
            <h1 class="font-display text-4xl md:text-5xl lg:text-7xl font-light text-white leading-tight">
                {{ $country->name }} <span class="text-gray-500 italic">Gallery</span>
            </h1>
            <p class="text-gray-400 max-w-2xl text-lg font-light leading-relaxed">
                A collection of moments captured in {{ $country->name }}.
            </p>
        </div>
    </header>

    <div class="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8 animate-slide-up">
        @forelse($photos as $photo)
            <x-photo-card :photo="$photo" :index="$loop->index" />
        @empty
            <div class="col-span-full text-center py-20">
                <p class="text-gray-500 text-xl font-light">No photos found for this gallery yet.</p>
            </div>
        @endforelse
    </div>
</x-public-layout>