@extends('layouts.app')

@section('title', isset($search) ? 'Search: ' . $search : 'Home')

@section('content')
    <section class="fd-hero py-16 md:py-20 mb-8">
        <div class="fd-container text-center fd-reveal">
            <p class="uppercase tracking-[0.24em] text-rose-100/90 text-xs font-semibold mb-3">Handcrafted Floral Artistry</p>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white drop-shadow-[0_2px_10px_rgba(0,0,0,0.2)]" style="font-family: 'Playfair Display', serif;">Fresh Flowers for Every Celebration</h1>
            <p class="text-rose-50/95 mb-8 max-w-2xl mx-auto">Elegant bouquets, curated color palettes, and thoughtful delivery for birthdays, anniversaries, and everything in between.</p>

            <form action="{{ route('home') }}" method="GET" class="max-w-2xl mx-auto mb-6">
                <div class="fd-panel overflow-hidden flex flex-col sm:flex-row items-stretch p-2 gap-2 bg-white/95">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search flowers, categories, occasions..." class="fd-input border-0 shadow-none bg-transparent flex-1">
                    <button type="submit" class="fd-btn-primary whitespace-nowrap px-5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                        Search
                    </button>
                </div>
            </form>

            @if(!isset($search))
                <a href="{{ route('shop.index') }}" class="fd-btn-ghost text-white border-white/50 bg-white/10 hover:bg-white/20 hover:border-white/70">
                    Explore Collection
                </a>
            @endif
        </div>
    </section>

<div class="fd-container">

    @if(isset($search))
        <section class="py-4 md:py-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-slate-800">Search Results for "{{ $search }}"</h2>
                <a href="{{ route('home') }}" class="fd-link text-sm font-semibold">Clear Search</a>
            </div>

            @if($flowers->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 fd-stagger">
                    @foreach($flowers as $flower)
                        @include('components.flower-card', ['flower' => $flower])
                    @endforeach
                </div>
                <div class="mt-8">{{ $flowers->links() }}</div>
            @else
                <div class="fd-panel text-center py-12 px-6">
                    <svg class="w-16 h-16 mx-auto mb-4 text-orange-200" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    <p class="text-slate-500 mb-4">No flowers found matching "{{ $search }}"</p>
                    <a href="{{ route('shop.index') }}" class="fd-link font-semibold">Browse All Flowers</a>
                </div>
            @endif
        </section>
    @else
        <section class="py-2 md:py-5">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Shop by Category</h2>
                <a href="{{ route('shop.index') }}" class="fd-link text-sm font-semibold">See all flowers</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 fd-stagger">
                @foreach($categories as $category)
                    <a href="{{ route('shop.category', $category->slug) }}" class="fd-panel-soft p-4 text-center transition hover:-translate-y-0.5 hover:shadow-sm">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mx-auto mb-2 border border-orange-100">
                            <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-700">{{ $category->name }}</h3>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="py-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">Featured Bouquets</h2>
                <a href="{{ route('shop.index') }}" class="fd-link text-sm font-semibold">View all</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 fd-stagger">
                @foreach($featuredFlowers as $flower)
                    @include('components.flower-card', ['flower' => $flower])
                @endforeach
            </div>
        </section>

        <section class="pb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">New Arrivals</h2>
                <a href="{{ route('shop.index') }}" class="fd-link text-sm font-semibold">View all</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 fd-stagger">
                @foreach($latestFlowers as $flower)
                    @include('components.flower-card', ['flower' => $flower])
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection