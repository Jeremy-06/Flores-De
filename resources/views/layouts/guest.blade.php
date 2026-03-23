<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Flores De') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased" style="font-family: 'Manrope', sans-serif;">
        <div class="min-h-screen relative overflow-hidden flex items-center justify-center px-4 py-10">
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute -top-28 -left-16 h-72 w-72 rounded-full bg-orange-200/30 blur-3xl"></div>
                <div class="absolute top-1/2 -right-24 h-80 w-80 rounded-full bg-amber-300/20 blur-3xl"></div>
            </div>

            <div class="w-full max-w-md relative z-10">
                <div class="text-center mb-5">
                    <a href="{{ route('home') }}" class="inline-flex flex-col items-center gap-2">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-400 to-red-500 text-white grid place-items-center shadow-lg">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        </div>
                        <span class="text-2xl font-bold text-slate-800" style="font-family: 'Playfair Display', serif;">Flores De</span>
                    </a>
                </div>

                <div class="fd-panel p-6 md:p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
