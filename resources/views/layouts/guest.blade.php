<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-[#0a0a0c]">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden bg-cover bg-center bg-no-repeat" style="background-image: url('{{ Storage::url('images/login-bg.png') }}');">
            <!-- 70% Black Overlay -->
            <div class="absolute inset-0 bg-black/70 z-0"></div>

            <!-- Background Decoration (kept for extra depth) -->
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-primary/10 blur-[120px] rounded-full z-0"></div>
            
            <div class="z-10 mb-8">
                <a href="/" class="flex flex-col items-center gap-2 group">
                    <div class="p-3 rounded-2xl bg-white/5 border border-white/10 group-hover:border-primary/50 transition-all duration-500 backdrop-blur-md">
                        <x-application-logo class="w-12 h-12 fill-current text-white" />
                    </div>
                    <h1 class="text-2xl font-bold text-white tracking-tighter italic">SouLens</h1>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-10 bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl overflow-hidden sm:rounded-2xl z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
