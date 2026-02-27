<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Flores De') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-800 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden"
             style="background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 25%, #fecdd3 50%, #fda4af 75%, #fb7185 100%);">

            <!-- Decorative Elements -->
            <div class="absolute top-10 left-10 w-32 h-32 bg-white/20 rounded-full blur-2xl animate-float"></div>
            <div class="absolute bottom-20 right-10 w-48 h-48 bg-rose-300/20 rounded-full blur-3xl animate-float-slow"></div>
            <div class="absolute top-1/3 right-1/4 w-24 h-24 bg-pink-200/30 rounded-full blur-2xl animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-1/3 left-1/4 w-36 h-36 bg-rose-200/20 rounded-full blur-2xl animate-float-slow" style="animation-delay: 1s;"></div>

            <!-- Floating petals SVG decorations -->
            <div class="absolute top-20 right-20 petal petal-1">
                <svg class="w-8 h-8 text-rose-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </div>
            <div class="absolute bottom-40 left-20 petal petal-2">
                <svg class="w-6 h-6 text-pink-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </div>
            <div class="absolute top-1/2 right-10 petal petal-3">
                <svg class="w-10 h-10 text-rose-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </div>

            <!-- Logo -->
            <div class="relative z-10 animate-fade-in-down">
                <a href="/" class="flex flex-col items-center gap-3 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-rose-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl shadow-rose-500/30 group-hover:shadow-rose-500/50 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    </div>
                    <div class="text-center">
                        <span class="text-3xl font-display font-bold text-gray-800">Flores De</span>
                        <p class="text-rose-500 text-xs tracking-[0.3em] uppercase font-medium">Flower Shop</p>
                    </div>
                </a>
            </div>

            <!-- Form Card -->
            <div class="relative z-10 w-full sm:max-w-md mt-8 mb-8 px-4 animate-fade-in-up">
                <div class="bg-white/90 backdrop-blur-xl border border-white/50 overflow-hidden rounded-3xl shadow-2xl shadow-rose-900/10 p-8">
                    {{ $slot }}
                </div>
            </div>

            <!-- Back to home link -->
            <a href="/" class="relative z-10 text-sm text-rose-700/60 hover:text-rose-800 transition-colors duration-300 mb-6 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Back to home
            </a>
        </div>
    </body>
</html>
