<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background-light text-slate-900 font-display overflow-hidden selection:bg-primary selection:text-white">
    <div class="flex h-screen w-full flex-col md:flex-row">
        <x-side-nav />

        <main
            class="flex-1 relative h-full w-full bg-[#141121] {{ $mainClasses ?? 'overflow-y-auto hide-scroll p-6 md:p-12 lg:p-16' }}">
            {{ $slot }}
        </main>
    </div>
</body>

</html>