@extends('layouts.app')

@section('title', $flower->name)

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('shop.index') }}" class="text-red-600 hover:underline text-sm">&larr; Back to Shop</a>
    </div>

    <div class="bg-white border border-gray-200 rounded overflow-hidden">
        <div class="lg:flex">
            <!-- Image -->
            <div class="lg:w-1/2">
                @if($flower->image)
                    <img id="mainImage" src="{{ asset('storage/' . $flower->image) }}" alt="{{ $flower->name }}" class="w-full h-[400px] object-cover">
                @else
                    <div class="w-full h-[400px] bg-gray-100 flex items-center justify-center">
                        <svg class="w-20 h-20 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                @endif

                {{-- Gallery Images --}}
                @if($flower->images->count())
                    <div class="flex flex-wrap gap-2 p-4 border-t">
                        @foreach($flower->images as $img)
                            <img src="{{ asset('storage/' . $img->image_path) }}" 
                                alt="{{ $flower->name }}" 
                                class="w-20 h-20 object-cover rounded cursor-pointer border-2 border-transparent hover:border-red-500 transition"
                                onclick="document.getElementById('mainImage').src = this.src">
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Details -->
            <div class="lg:w-1/2 p-8">
                <p class="text-sm text-gray-500 mb-1">
                    <a href="{{ route('shop.category', $flower->category->slug) }}" class="text-red-600 hover:underline">{{ $flower->category->name }}</a>
                </p>
                <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $flower->name }}</h1>
                <p class="text-2xl font-bold text-red-600 mb-6">₱{{ number_format($flower->price, 2) }}</p>

                <p class="text-gray-600 mb-6">{{ $flower->description }}</p>

                @if($flower->stock > 0)
                    <p class="text-green-600 text-sm font-semibold mb-4">In Stock ({{ $flower->stock }} available)</p>

                    <form action="{{ route('cart.add') }}" method="POST" class="flex items-end gap-4 mb-6">
                        @csrf
                        <input type="hidden" name="flower_id" value="{{ $flower->id }}">
                        <div>
                            <label class="text-sm text-gray-600 block mb-1">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $flower->stock }}" class="border border-gray-300 rounded px-3 py-2 w-20 text-center text-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                        <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded font-semibold hover:bg-red-700">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <p class="text-red-600 text-sm font-semibold mb-6">Out of Stock</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Flowers -->
    @if($relatedFlowers->count() > 0)
        <section class="mt-12">
            <h2 class="text-xl font-bold text-gray-800 mb-6">You May Also Like</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($relatedFlowers as $related)
                    @include('components.flower-card', ['flower' => $related])
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection