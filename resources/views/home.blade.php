@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <!-- Gradient Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-rose-600 via-pink-600 to-rose-700"></div>

        <!-- Animated decorative elements -->
        <div class="absolute top-10 left-10 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-pink-300/10 rounded-full blur-3xl animate-float-slow"></div>
        <div class="absolute top-1/2 left-1/3 w-40 h-40 bg-rose-400/10 rounded-full blur-2xl animate-float" style="animation-delay: 3s;"></div>

        <!-- Floating hearts decoration -->
        <div class="absolute top-20 right-[15%] petal petal-1 opacity-20">
            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        </div>
        <div class="absolute bottom-20 left-[10%] petal petal-2 opacity-15">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        </div>
        <div class="absolute top-1/3 right-[5%] petal petal-3 opacity-10">
            <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32 text-center">
            <div class="animate-fade-in-up">
                <span class="inline-block px-4 py-1.5 bg-white/15 backdrop-blur-sm text-white/90 text-xs font-semibold tracking-[0.2em] uppercase rounded-full mb-6 border border-white/20">
                    Fresh Flowers Daily
                </span>
                <h1 class="text-4xl sm:text-5xl md:text-7xl font-display font-bold text-white mb-6 leading-tight text-balance">
                    Fresh Flowers for<br>
                    <span class="italic text-rose-200">Every Occasion</span>
                </h1>
                <p class="text-rose-100 text-lg md:text-xl mb-10 max-w-2xl mx-auto font-light leading-relaxed">
                    Handcrafted bouquets delivered with care. Make someone's day special with our stunning floral arrangements.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('shop.index') }}" class="group inline-flex items-center gap-3 bg-white text-rose-600 px-8 py-4 rounded-2xl font-bold text-lg shadow-2xl shadow-black/20 hover:shadow-white/30 hover:bg-rose-50 transform hover:-translate-y-1 transition-all duration-300">
                        Shop Now
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                    <a href="#categories" class="inline-flex items-center gap-2 text-white/80 hover:text-white px-6 py-4 font-medium transition-colors duration-300">
                        <span>Browse Categories</span>
                        <svg class="w-4 h-4 animate-bounce-soft" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Stats Strip -->
            <div class="mt-16 grid grid-cols-3 gap-4 max-w-lg mx-auto animate-fade-in" style="animation-delay: 0.5s;">
                <div class="text-center">
                    <p class="text-3xl font-bold text-white">500+</p>
                    <p class="text-rose-200 text-xs tracking-wide">Happy Customers</p>
                </div>
                <div class="text-center border-x border-white/20">
                    <p class="text-3xl font-bold text-white">50+</p>
                    <p class="text-rose-200 text-xs tracking-wide">Bouquet Designs</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-white">4.9</p>
                    <p class="text-rose-200 text-xs tracking-wide flex items-center justify-center gap-1">
                        <svg class="w-3 h-3 text-yellow-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        Star Rating
                    </p>
                </div>
            </div>
        </div>

        <!-- Curved bottom -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white" fill-opacity="0.05"/>
                <path d="M0 120L60 115C120 110 240 100 360 95C480 90 600 90 720 92C840 95 960 100 1080 102C1200 105 1320 105 1380 105L1440 105V120H0Z" class="fill-rose-25"/>
            </svg>
        </div>
    </div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Categories -->
    <section id="categories" class="py-16 md:py-20">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1 bg-rose-100 text-rose-600 text-xs font-bold tracking-[0.2em] uppercase rounded-full mb-4">Categories</span>
            <h2 class="section-title">Shop by Occasion</h2>
            <p class="section-subtitle">Find the perfect bouquet for every special moment in life</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('shop.category', $category->slug) }}" class="group relative bg-white rounded-2xl p-6 text-center border border-rose-100/50 hover:border-rose-300 transition-all duration-500 hover:-translate-y-2 hover:shadow-xl hover:shadow-rose-500/10">
                    <!-- Decorative gradient on hover -->
                    <div class="absolute inset-0 bg-gradient-to-br from-rose-50 to-pink-50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative">
                        <div class="w-14 h-14 bg-gradient-to-br from-rose-100 to-pink-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:from-rose-200 group-hover:to-pink-200 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 shadow-sm">
                            <svg class="w-6 h-6 text-rose-500 group-hover:text-rose-600 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        </div>
                        <h3 class="font-semibold text-sm text-gray-700 group-hover:text-rose-700 transition-colors">{{ $category->name }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Featured Flowers -->
    <section class="pb-16 md:pb-20">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="inline-block px-4 py-1 bg-rose-100 text-rose-600 text-xs font-bold tracking-[0.2em] uppercase rounded-full mb-3">Featured</span>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-800">Featured Bouquets</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="group flex items-center gap-2 text-rose-600 font-semibold text-sm hover:text-rose-700 transition-colors">
                View all
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($featuredFlowers as $flower)
                @include('components.flower-card', ['flower' => $flower])
            @endforeach
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-16 md:py-20">
        <div class="relative bg-gradient-to-br from-rose-50 via-pink-50 to-rose-100 rounded-3xl p-10 md:p-16 overflow-hidden">
            <!-- Decorative -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-rose-200/30 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-pink-200/30 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

            <div class="relative">
                <div class="text-center mb-12">
                    <span class="inline-block px-4 py-1 bg-white/80 text-rose-600 text-xs font-bold tracking-[0.2em] uppercase rounded-full mb-4">Why Us</span>
                    <h2 class="section-title">Why Choose <span class="italic gradient-text">Flores De</span></h2>
                    <p class="section-subtitle">We're dedicated to bringing joy through the beauty of flowers</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center group">
                        <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-elegant group-hover:shadow-xl group-hover:-translate-y-2 group-hover:scale-105 transition-all duration-500">
                            <svg class="w-9 h-9 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                        </div>
                        <h3 class="font-display font-bold text-xl text-gray-800 mb-3">Same Day Delivery</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Order before 2pm for same day delivery across Metro Manila</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-elegant group-hover:shadow-xl group-hover:-translate-y-2 group-hover:scale-105 transition-all duration-500">
                            <svg class="w-9 h-9 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"/></svg>
                        </div>
                        <h3 class="font-display font-bold text-xl text-gray-800 mb-3">Farm Fresh</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Sourced directly from local farms to ensure the freshest blooms</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-elegant group-hover:shadow-xl group-hover:-translate-y-2 group-hover:scale-105 transition-all duration-500">
                            <svg class="w-9 h-9 text-rose-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        </div>
                        <h3 class="font-display font-bold text-xl text-gray-800 mb-3">Crafted with Love</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Each arrangement is lovingly handcrafted by our expert florists</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Banner -->
    <section class="pb-16 md:pb-20">
        <div class="relative bg-gradient-to-r from-rose-600 via-pink-600 to-rose-700 rounded-3xl p-10 md:p-16 text-center overflow-hidden">
            <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
            <div class="relative">
                <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-4">Make Someone's Day Special</h2>
                <p class="text-rose-100 mb-8 max-w-lg mx-auto">Send a beautiful bouquet to your loved ones. We deliver happiness right to their door.</p>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 bg-white text-rose-600 px-8 py-4 rounded-2xl font-bold shadow-2xl shadow-black/10 hover:bg-rose-50 transform hover:-translate-y-1 transition-all duration-300">
                    Order Now
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Latest Arrivals -->
    <section class="pb-16 md:pb-20">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="inline-block px-4 py-1 bg-emerald-100 text-emerald-600 text-xs font-bold tracking-[0.2em] uppercase rounded-full mb-3">Just In</span>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-800">New Arrivals</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="group flex items-center gap-2 text-rose-600 font-semibold text-sm hover:text-rose-700 transition-colors">
                View all
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($latestFlowers as $flower)
                @include('components.flower-card', ['flower' => $flower])
            @endforeach
        </div>
    </section>
</div>
@endsection