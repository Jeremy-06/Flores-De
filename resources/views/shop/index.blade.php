@extends('layouts.app')

@section('title', isset($category) ? $category->name : 'Shop')

@section('content')
<!-- Page Header -->
<div class="relative bg-gradient-to-r from-rose-600 via-pink-600 to-rose-700 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-pink-400/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
        <h1 class="text-3xl md:text-4xl font-display font-bold text-white mb-2">
            {{ isset($category) ? $category->name : 'Our Collection' }}
        </h1>
        <p class="text-rose-100 text-sm">Discover the perfect arrangement for every occasion</p>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 40" fill="none"><path d="M0 40L1440 40L1440 20Q1200 0 720 20Q240 40 0 20Z" class="fill-rose-25"/></svg>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar -->
        <aside class="w-full lg:w-64 flex-shrink-0 space-y-6">
            <!-- Categories Card -->
            <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm p-6">
                <h3 class="font-display font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="w-8 h-8 bg-gradient-to-br from-rose-100 to-pink-100 rounded-xl flex items-center justify-center">
                        <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                    </span>
                    Categories
                </h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('shop.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm transition-all duration-300 {{ !isset($category) ? 'bg-gradient-to-r from-rose-500 to-pink-500 text-white font-semibold shadow-md shadow-rose-500/25' : 'text-gray-600 hover:bg-rose-50 hover:text-rose-600' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6z"/></svg>
                            All Flowers
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('shop.category', $cat->slug) }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm transition-all duration-300 {{ isset($category) && $category->id === $cat->id ? 'bg-gradient-to-r from-rose-500 to-pink-500 text-white font-semibold shadow-md shadow-rose-500/25' : 'text-gray-600 hover:bg-rose-50 hover:text-rose-600' }}">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Search Card -->
            <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm p-6">
                <h3 class="font-display font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="w-8 h-8 bg-gradient-to-br from-rose-100 to-pink-100 rounded-xl flex items-center justify-center">
                        <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    </span>
                    Search
                </h3>
                <form action="{{ route('shop.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search flowers..." class="input-elegant w-full pr-10 text-sm">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-gradient-to-r from-rose-500 to-pink-500 text-white rounded-lg flex items-center justify-center hover:from-rose-600 hover:to-pink-600 transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </aside>

        <!-- Flowers Grid -->
        <div class="flex-1">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <p class="text-sm text-gray-500">Showing <span class="font-semibold text-gray-700">{{ $flowers->count() }}</span> results</p>
                <select onchange="window.location.href=this.value" class="input-elegant text-sm py-2 px-4 pr-10">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest First</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'name']) }}" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                </select>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                @forelse($flowers as $flower)
                    @include('components.flower-card', ['flower' => $flower])
                @empty
                    <div class="col-span-3 text-center py-20">
                        <div class="w-20 h-20 bg-rose-50 rounded-3xl flex items-center justify-center mx-auto mb-5">
                            <svg class="w-10 h-10 text-rose-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                        </div>
                        <h3 class="font-display font-bold text-gray-700 text-lg mb-2">No flowers found</h3>
                        <p class="text-gray-400 text-sm mb-6">Try adjusting your search or browse all categories</p>
                        <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 btn-primary text-sm px-6 py-2.5">
                            Browse All
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $flowers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection