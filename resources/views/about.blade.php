<x-public-layout mainClasses="flex flex-col lg:flex-row p-0 overflow-y-auto hide-scroll">
    <!-- Content Left: Text Section -->
    <div class="flex-1 flex flex-col justify-center items-center p-8 lg:p-16 xl:p-24 relative z-10">
        <div class="w-full max-w-lg flex flex-col gap-10">
            <!-- Header -->
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-3 text-xs tracking-[0.2em] text-primary uppercase font-bold">
                    <span class="h-px w-8 bg-primary"></span>
                    <span>The Artist</span>
                </div>
                <h2 class="font-display text-4xl md:text-5xl font-light text-white leading-tight">
                    SouLens <br /><span class="font-bold text-gray-400 italic">Visual Storyteller</span>
                </h2>
            </div>

            <!-- Bio -->
            <div class="font-display text-gray-400 text-lg font-light leading-relaxed flex flex-col gap-6">
                <p>
                    Soy fotógrafa aficionada residenciada en Venezuela. Me interesa la relación entre luces y sombras,
                    los momentos de calma dentro de ciudades caóticas y el silencio de la naturaleza.
                    Tengo una especial debilidad por los amaneceres y atardeceres, donde suelo encontrar mi inspiración.
                </p>
                <p>
                    Desde la afición y la pasión por la fotografía, busco capturar la belleza que a menudo pasa
                    desapercibida,
                    transformando instantes fugaces en recuerdos sencillos pero significativos.
                </p>
            </div>

            <!-- Stats/Details -->
            <div class="grid grid-cols-2 gap-8 border-t border-white/10 pt-8 mt-4">
                <div class="flex flex-col gap-1">
                    <span class="text-3xl font-bold text-white">{{ \App\Models\Photo::count() }}</span>
                    <span class="text-xs uppercase tracking-widest text-gray-500">INSTANTES<br>CAPTURADOS</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-3xl font-bold text-white">{{ \App\Models\Photo::whereNotNull('city')->distinct('city')->count('city') }}</span>
                    <span class="text-xs uppercase tracking-widest text-gray-500">CIUDADES<br>FOTOGRAFIADAS</span>
                </div>
            </div>

            <!-- Signature / CTA -->
            <div class="pt-6">
                <img src="{{ Storage::url('photos/signature.png') }}" alt="Signature"
                    class="h-12 invert opacity-50 mb-6">
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 text-primary hover:text-white transition-colors font-bold tracking-wide uppercase text-sm group">
                    <span>Get in Touch</span>
                    <span
                        class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_right_alt</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Content Right: Image Section -->
    <div
        class="hidden lg:flex w-1/3 xl:w-5/12 bg-[#0a0a0f] relative justify-center items-center p-6 border-l border-white/5">
        <div class="relative w-full h-[85%] rounded-2xl overflow-hidden shadow-2xl group">
            <!-- Profile Image -->
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                style="background-image: url('{{ Storage::url('photos/ruthg.jpg') }}');">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60">
            </div>
        </div>
    </div>
</x-public-layout>