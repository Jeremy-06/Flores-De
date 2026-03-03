<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Flores De') }} - @yield('title', 'Home')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    <span class="text-lg font-bold text-gray-800">Flores De</span>
                </a>

                <!-- Navigation Links -->
                <div class="flex items-center gap-4 text-sm">
                    <a href="{{ route('shop.index') }}" class="text-gray-600 hover:text-red-600">Shop</a>
                    <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-red-600 relative">
                        Cart
                        @if(\Cart::getContent()->count() > 0)
                            <span class="absolute -top-2 -right-3 bg-red-600 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center">{{ \Cart::getContent()->count() }}</span>
                        @endif
                    </a>

                    @auth
                        <a href="{{ route('orders.index') }}" class="text-gray-600 hover:text-red-600">My Orders</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-red-600">Admin</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-red-600">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-red-600">Login</a>
                        <a href="{{ route('register') }}" class="bg-red-600 text-white px-4 py-1.5 rounded text-sm hover:bg-red-700">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded text-sm">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded text-sm">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Main Content -->
    <main class="flex-1 py-6">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} Flores De. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>