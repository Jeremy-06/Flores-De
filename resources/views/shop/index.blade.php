@extends('layouts.app')

@section('title', isset($category) ? $category->name : 'Shop')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">
        {{ isset($category) ? $category->name : 'Our Collection' }}
    </h1>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar -->
        <aside class="w-full lg:w-56 flex-shrink-0 space-y-6">
            <!-- Categories -->
            <div class="bg-white border border-gray-200 rounded p-4">
                <h3 class="font-bold text-gray-800 mb-3">Categories</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('shop.index') }}" class="block px-2 py-1 rounded text-sm {{ !isset($category) && !request('category') ? 'bg-red-600 text-white font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                            All Flowers
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('shop.index', ['category' => $cat->slug]) }}" class="block px-2 py-1 rounded text-sm {{ (isset($category) && $category->id === $cat->id) || request('category') == $cat->slug ? 'bg-red-600 text-white font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Price Range Filter -->
            <div class="bg-white border border-gray-200 rounded p-4">
                <h3 class="font-bold text-gray-800 mb-3">Price Range</h3>
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
                        <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="border border-gray-300 rounded px-2 py-1.5 text-sm w-1/2 focus:border-red-500 focus:ring-red-500" min="0">
                        <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="border border-gray-300 rounded px-2 py-1.5 text-sm w-1/2 focus:border-red-500 focus:ring-red-500" min="0">
                    </div>
                    <button type="submit" class="w-full bg-red-600 text-white py-1.5 rounded text-sm hover:bg-red-700">Apply</button>
                </form>
                @if(request('min_price') || request('max_price'))
                    <a href="{{ route('shop.index', request()->only(['category', 'search', 'sort'])) }}" class="block text-center text-xs text-gray-500 mt-2 hover:underline">Clear Price Filter</a>
                @endif
            </div>

            <!-- Search -->
            <div class="bg-white border border-gray-200 rounded p-4">
                <h3 class="font-bold text-gray-800 mb-3">Search</h3>
                <form action="{{ route('shop.index') }}" method="GET">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search flowers..." class="border border-gray-300 rounded px-3 py-2 text-sm w-full focus:border-red-500 focus:ring-red-500">
                        <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded text-sm hover:bg-red-700">Go</button>
                    </div>
                </form>
                @if(request('search'))
                    <a href="{{ route('shop.index', request()->only(['category', 'min_price', 'max_price', 'sort'])) }}" class="block text-xs text-gray-500 mt-2 hover:underline">Clear Search</a>
                @endif
            </div>

            @if(request('category') || request('search') || request('min_price') || request('max_price'))
                <a href="{{ route('shop.index') }}" class="block text-center bg-gray-100 text-gray-600 py-2 rounded text-sm hover:bg-gray-200">Clear All Filters</a>
            @endif
        </aside>

        <!-- Flowers Grid -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-4">
                <p class="text-sm text-gray-500">Showing {{ $flowers->count() }} results</p>
                <select onchange="window.location.href=this.value" class="border border-gray-300 rounded px-3 py-1.5 text-sm focus:border-red-500 focus:ring-red-500">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest First</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'name']) }}" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                </select>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @forelse($flowers as $flower)
                    @include('components.flower-card', ['flower' => $flower])
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 mb-4">No flowers found.</p>
                        <a href="{{ route('shop.index') }}" class="text-red-600 hover:underline text-sm">Browse All</a>
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