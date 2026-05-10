@props(['photo', 'index'])

<div class="break-inside-avoid relative group overflow-hidden rounded-lg animate-slide-up"
    style="animation-delay: {{ ($index * 0.1) + 0.1 }}s;">
    <img src="{{ Storage::url($photo->image_path) }}" alt="{{ $photo->description }}"
        class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy" />

    <div
        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-8">
        <span
            class="text-primary text-xs font-bold tracking-widest uppercase mb-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75">
            {{ optional($photo->country)->name ?? 'Travel' }}
        </span>
        <h3
            class="text-white text-2xl font-normal mb-1 translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100">
            {{ $photo->title ?? $photo->city }}
        </h3>
        <div
            class="flex justify-between items-end mt-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-150 border-t border-white/20 pt-4">
            <span class="text-slate-300 text-sm font-light">{{ $photo->city }},
                {{ optional($photo->country)->name }}</span>
            <span class="text-slate-400 text-xs">{{ $photo->date ? $photo->date->format('F Y') : '' }}</span>
        </div>
    </div>
</div>