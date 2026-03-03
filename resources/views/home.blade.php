@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="bg-red-600 text-white py-16">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Fresh Flowers for Every Occasion</h1>
            <p class="text-red-100 mb-8 max-w-xl mx-auto">Handcrafted bouquets delivered with care. Make someone's day special with our stunning floral arrangements.</p>
            <a href="{{ route('shop.index') }}" class="inline-block bg-white text-red-600 px-6 py-3 rounded font-semibold hover:bg-gray-100">
                Shop Now
            </a>
        </div>
    </div>

<div class="max-w-6xl mx-auto px-4">
    <!-- Categories -->
    <section class="py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Shop by Category</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('shop.category', $category->slug) }}" class="bg-white border border-gray-200 rounded p-4 text-center hover:border-red-300 hover:shadow">
                    <div class="w-10 h-10 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-700">{{ $category->name }}</h3>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Featured Flowers -->
    <section class="pb-12">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Featured Bouquets</h2>
            <a href="{{ route('shop.index') }}" class="text-red-600 hover:underline text-sm font-semibold">View all</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($featuredFlowers as $flower)
                @include('components.flower-card', ['flower' => $flower])
            @endforeach
        </div>
    </section>

    <!-- Latest Arrivals -->
    <section class="pb-12">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">New Arrivals</h2>
            <a href="{{ route('shop.index') }}" class="text-red-600 hover:underline text-sm font-semibold">View all</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($latestFlowers as $flower)
                @include('components.flower-card', ['flower' => $flower])
            @endforeach
        </div>
    </section>
</div>
@endsection