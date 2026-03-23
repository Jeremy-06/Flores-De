@extends('layouts.app')

@section('title', isset($category) ? $category->name : 'Shop')

@section('content')
<div class="fd-container py-4 md:py-8">
    <h1 class="text-3xl font-bold mb-6" style="font-family: 'Playfair Display', serif;">
        {{ isset($category) ? $category->name : 'Our Collection' }}
    </h1>

    <div class="flex flex-col lg:flex-row gap-6">
        <aside class="w-full lg:w-56 flex-shrink-0 space-y-4">
            <div class="fd-panel p-4">
                <h3 class="font-bold text-slate-800 mb-3 text-sm">Categories</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('shop.index') }}" class="block px-2 py-1.5 rounded text-sm {{ !isset($category) && !request('category') ? 'bg-orange-600 text-white font-semibold' : 'text-slate-600 hover:bg-orange-50' }}">
                            All Flowers
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('shop.index', ['category' => $cat->slug]) }}" class="block px-2 py-1.5 rounded text-sm {{ (isset($category) && $category->id === $cat->id) || request('category') == $cat->slug ? 'bg-orange-600 text-white font-semibold' : 'text-slate-600 hover:bg-orange-50' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="fd-panel p-4">
                <h3 class="font-bold text-slate-800 mb-3 text-sm">Price Range</h3>
                <form action="{{ route('shop.index') }}" method="GET">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    <div class="flex gap-2 mb-2">
                        <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="fd-input w-1/2" min="0">
                        <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="fd-input w-1/2" min="0">
                    </div>
                    <button type="submit" class="w-full fd-btn-primary text-sm">Apply</button>
                </form>
                @if(request('min_price') || request('max_price'))
                    <a href="{{ route('shop.index', request()->only(['category', 'search', 'sort'])) }}" class="block text-center text-xs text-slate-500 mt-2 hover:underline">Clear Price Filter</a>
                @endif
            </div>

            <div class="fd-panel p-4">
                <h3 class="font-bold text-slate-800 mb-3 text-sm">Search</h3>
                <form action="{{ route('shop.index') }}" method="GET">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search flowers..." class="fd-input">
                        <button type="submit" class="fd-btn-primary text-sm px-3">Go</button>
                    </div>
                </form>
                @if(request('search'))
                    <a href="{{ route('shop.index', request()->only(['category', 'min_price', 'max_price', 'sort'])) }}" class="block text-xs text-slate-500 mt-2 hover:underline">Clear Search</a>
                @endif
            </div>

            @if(request('category') || request('search') || request('min_price') || request('max_price'))
                <a href="{{ route('shop.index') }}" class="block text-center bg-slate-100 text-slate-600 py-2 rounded-lg text-sm hover:bg-slate-200">Clear All Filters</a>
            @endif
        </aside>

        <div class="flex-1">
            <div class="fd-panel p-4 flex flex-col sm:flex-row justify-between sm:items-center mb-4 gap-3">
                <p class="text-sm text-slate-500">Showing {{ $flowers->count() }} results</p>
                <select onchange="window.location.href=this.value" class="fd-select sm:w-auto">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest First</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'name']) }}" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5 fd-stagger">
                @forelse($flowers as $flower)
                    @include('components.flower-card', ['flower' => $flower])
                @empty
                    <div class="sm:col-span-2 xl:col-span-3 text-center py-12 fd-panel">
                        <p class="text-slate-500 mb-4">No flowers found.</p>
                        <a href="{{ route('shop.index') }}" class="fd-link text-sm font-semibold">Browse All</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $flowers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection