@extends('layouts.app')

@section('title', $flower->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-8">
        <a href="{{ route('home') }}" class="hover:text-rose-500 transition-colors">Home</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
        <a href="{{ route('shop.index') }}" class="hover:text-rose-500 transition-colors">Shop</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
        <span class="text-gray-600 font-medium">{{ $flower->name }}</span>
    </nav>

    <div class="bg-white rounded-3xl border border-rose-100/50 shadow-sm overflow-hidden">
        <div class="lg:flex">
            <!-- Image -->
            <div class="lg:w-1/2 relative group">
                @if($flower->image)
                    <img 
                        src="{{ asset('storage/' . $flower->image) }}" 
                        alt="{{ $flower->name }}"
                        class="w-full h-[400px] lg:h-full object-cover group-hover:scale-105 transition-transform duration-700"
                    >
                @else
                    <div class="w-full h-[400px] lg:h-full bg-gradient-to-br from-rose-50 via-pink-50 to-rose-100 flex flex-col items-center justify-center">
                        <svg class="w-24 h-24 text-rose-200 mb-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                        <span class="text-rose-300 text-sm font-medium">No image available</span>
                    </div>
                @endif
                <!-- Category Badge -->
                <span class="absolute top-6 left-6 bg-white/90 backdrop-blur-sm text-rose-600 px-4 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase shadow-lg">
                    {{ $flower->category->name }}
                </span>
            </div>

            <!-- Details -->
            <div class="lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center">
                <div>
                    <a href="{{ route('shop.category', $flower->category->slug) }}" class="inline-flex items-center gap-1.5 text-rose-500 text-sm font-medium hover:text-rose-600 transition-colors mb-3">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        {{ $flower->category->name }}
                    </a>
                    <h1 class="text-3xl lg:text-4xl font-display font-bold text-gray-800 mb-4">{{ $flower->name }}</h1>
                    <p class="text-3xl font-bold gradient-text mb-6">₱{{ number_format($flower->price, 2) }}</p>
                    
                    <p class="text-gray-500 leading-relaxed mb-8">{{ $flower->description }}</p>

                    @if($flower->stock > 0)
                        <div class="flex items-center gap-2 mb-6">
                            <span class="w-2.5 h-2.5 bg-emerald-400 rounded-full animate-pulse-soft"></span>
                            <span class="text-emerald-600 text-sm font-semibold">In Stock</span>
                            <span class="text-gray-400 text-sm">({{ $flower->stock }} available)</span>
                        </div>
                        
                        <form action="{{ route('cart.add') }}" method="POST" class="flex items-end gap-4 mb-8">
                            @csrf
                            <input type="hidden" name="flower_id" value="{{ $flower->id }}">
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5 block">Quantity</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $flower->stock }}" class="input-elegant w-24 text-center text-sm">
                            </div>
                            <button type="submit" class="flex-1 btn-primary py-3.5 text-sm flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                                Add to Cart
                            </button>
                        </form>
                    @else
                        <div class="flex items-center gap-2 mb-6 bg-red-50 px-4 py-3 rounded-xl">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span class="text-red-600 text-sm font-semibold">Out of Stock</span>
                        </div>
                    @endif

                    <!-- Features -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-6 border-t border-rose-100">
                        <div class="flex items-center gap-3 p-3 bg-rose-50/50 rounded-xl">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-700">Same Day</p>
                                <p class="text-[10px] text-gray-400">Delivery available</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-rose-50/50 rounded-xl">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-700">Gift Wrap</p>
                                <p class="text-[10px] text-gray-400">Available option</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-rose-50/50 rounded-xl">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-700">100% Fresh</p>
                                <p class="text-[10px] text-gray-400">Guaranteed quality</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Flowers -->
    @if($relatedFlowers->count() > 0)
        <section class="mt-16">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="inline-block px-4 py-1 bg-rose-100 text-rose-600 text-xs font-bold tracking-[0.2em] uppercase rounded-full mb-3">Similar</span>
                    <h2 class="text-2xl md:text-3xl font-display font-bold text-gray-800">You May Also Like</h2>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedFlowers as $related)
                    @include('components.flower-card', ['flower' => $related])
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection