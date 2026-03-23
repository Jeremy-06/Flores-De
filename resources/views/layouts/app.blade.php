<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Flores De') }} - @yield('title', 'Home')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="antialiased text-slate-800" style="font-family: 'Manrope', sans-serif;">
    @php
        $logoCandidates = [
            'images/flores-de-logo.png',
            'images/flores-de-logo.jpg',
            'images/flores-de-logo.jpeg',
            'images/flores-de-logo.webp',
        ];
        $logoPath = collect($logoCandidates)->first(fn ($path) => file_exists(public_path($path)));
        $logoAsset = $logoPath ? asset($logoPath) : null;
    @endphp
    <div class="fd-shell">
        <nav x-data="{ mobileOpen: false, profileOpen: false }" class="sticky top-0 z-40 backdrop-blur bg-white/80 border-b border-orange-100/80">
            <div class="fd-container">
                <div class="h-[72px] flex items-center justify-between">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        @if($logoAsset)
                            <img src="{{ $logoAsset }}" alt="Flores De Logo" class="h-11 md:h-12 w-auto object-contain">
                        @else
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-red-700 to-red-900 text-white text-xs font-bold grid place-items-center shadow-md">FD</div>
                        @endif
                        <div>
                            <p class="text-[11px] uppercase tracking-[0.2em] text-orange-600 font-semibold">Flores De</p>
                            <p class="text-sm font-bold text-slate-800">Fresh Flower Studio</p>
                        </div>
                    </a>

                    <div class="hidden md:flex items-center gap-3 text-sm font-medium">
                        <a href="{{ route('home') }}" class="px-3 py-2 rounded-xl transition {{ request()->routeIs('home') ? 'bg-orange-100 text-orange-700' : 'text-slate-600 hover:bg-orange-50 hover:text-orange-700' }}">Home</a>
                        <a href="{{ route('shop.index') }}" class="px-3 py-2 rounded-xl transition {{ request()->routeIs('shop.*') ? 'bg-orange-100 text-orange-700' : 'text-slate-600 hover:bg-orange-50 hover:text-orange-700' }}">Shop</a>
                        <a href="{{ route('cart.index') }}" class="relative px-3 py-2 rounded-xl transition {{ request()->routeIs('cart.*') ? 'bg-orange-100 text-orange-700' : 'text-slate-600 hover:bg-orange-50 hover:text-orange-700' }}">
                            Cart
                            <span id="cart-count-badge" class="absolute -top-1 -right-1 min-w-5 h-5 px-1 rounded-full text-[10px] bg-orange-600 text-white font-semibold grid place-items-center {{ \Cart::getContent()->count() > 0 ? '' : 'hidden' }}">{{ \Cart::getContent()->count() }}</span>
                        </a>

                        @auth
                            <a href="{{ route('orders.index') }}" class="px-3 py-2 rounded-xl transition {{ request()->routeIs('orders.*') ? 'bg-orange-100 text-orange-700' : 'text-slate-600 hover:bg-orange-50 hover:text-orange-700' }}">My Orders</a>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-xl transition {{ request()->routeIs('admin.*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">Admin</a>
                            @endif

                            <div class="relative">
                                <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 px-2.5 py-1.5 rounded-xl border border-orange-100 bg-white hover:bg-orange-50">
                                    @if(auth()->user()->photo)
                                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="w-8 h-8 rounded-full object-cover border border-orange-100" alt="Avatar">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-700 text-xs font-bold grid place-items-center">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                                    @endif
                                    <span class="max-w-[120px] truncate text-sm text-slate-700">{{ auth()->user()->name }}</span>
                                    <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                </button>
                                <div x-show="profileOpen" @click.away="profileOpen = false" x-transition class="absolute right-0 mt-2 w-52 fd-panel py-1.5 z-50">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-orange-50">My Profile</a>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-orange-50">Logout</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="px-3 py-2 rounded-xl text-slate-600 hover:bg-orange-50 hover:text-orange-700">Login</a>
                            <a href="{{ route('register') }}" class="fd-btn-primary text-sm">Create Account</a>
                        @endauth
                    </div>

                    <button @click="mobileOpen = !mobileOpen" class="md:hidden w-10 h-10 rounded-xl border border-orange-100 bg-white text-slate-700 grid place-items-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
                <div x-show="mobileOpen" x-transition class="md:hidden pb-4 space-y-2">
                    <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-xl bg-white border border-orange-100 text-slate-700">Home</a>
                    <a href="{{ route('shop.index') }}" class="block px-4 py-2.5 rounded-xl bg-white border border-orange-100 text-slate-700">Shop</a>
                    <a href="{{ route('cart.index') }}" class="block px-4 py-2.5 rounded-xl bg-white border border-orange-100 text-slate-700">Cart</a>
                    @auth
                        <a href="{{ route('orders.index') }}" class="block px-4 py-2.5 rounded-xl bg-white border border-orange-100 text-slate-700">My Orders</a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 rounded-xl bg-white border border-orange-100 text-slate-700">Profile</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 rounded-xl bg-slate-800 text-white">Admin</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2.5 rounded-xl bg-white border border-orange-100 text-slate-700">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2.5 rounded-xl bg-white border border-orange-100 text-slate-700">Login</a>
                        <a href="{{ route('register') }}" class="block px-4 py-2.5 rounded-xl bg-orange-600 text-white">Create Account</a>
                    @endauth
                </div>
            </div>
        </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="fd-container mt-4">
            <div class="fd-panel px-4 py-3 text-sm border-green-200 bg-green-50 text-green-700">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fd-container mt-4">
            <div class="fd-panel px-4 py-3 text-sm border-red-200 bg-red-50 text-red-700">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Page Heading -->
    @isset($header)
        <header class="fd-container py-5">
            <div class="fd-panel px-5 py-4">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Main Content -->
    <main class="flex-1 py-6 md:py-8">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <footer class="mt-auto border-t border-orange-100 bg-white/75 backdrop-blur">
        <div class="fd-container py-5">
            <div class="flex flex-col md:flex-row items-center justify-between gap-3 text-sm">
                <div class="flex items-center gap-2">
                    @if($logoAsset)
                        <img src="{{ $logoAsset }}" alt="Flores De Logo" class="h-9 w-auto object-contain">
                    @else
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-red-700 to-red-900 text-white text-[10px] font-bold grid place-items-center">FD</div>
                    @endif
                    <span class="font-semibold text-slate-700">Flores De</span>
                </div>

                <div class="flex items-center gap-4 text-slate-500">
                    <a href="{{ route('home') }}" class="hover:text-orange-600">Home</a>
                    <a href="{{ route('shop.index') }}" class="hover:text-orange-600">Shop</a>
                    <a href="{{ route('cart.index') }}" class="hover:text-orange-600">Cart</a>
                </div>

                <div class="text-slate-500">&copy; {{ date('Y') }} Flores De</div>
            </div>
        </div>
    </footer>

    </div>

    @stack('scripts')
</body>
</html>