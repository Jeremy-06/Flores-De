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
            <!-- Reviews Section -->
            <div class="mt-8">
                <h3 class="text-xl font-bold mb-4">Customer Reviews ({{ $flower->reviews->count() }})</h3>
                @auth
                    @php
                        /** @var \App\Models\Flower $flower */
                        $hasBought = auth()->user()->orders()->where('status', 'delivered')
                            ->whereHas('items', fn($q) => $q->where('flower_id', $flower->id))->exists();
                        $existingReview = $flower->reviews->where('user_id', auth()->id())->first();
                    @endphp
                    @if($hasBought && !$existingReview)
                    <form action="{{ route('reviews.store') }}" method="POST" class="bg-gray-50 rounded p-4 mb-4">
                        @csrf
                        <input type="hidden" name="flower_id" value="{{ $flower->id }}">
                        <div class="mb-2">
                            <label class="text-sm font-medium">Rating</label>
                            <select name="rating" class="border rounded px-2 py-1" required>
                                <option value="5">★★★★★</option>
                                <option value="4">★★★★</option>
                                <option value="3">★★★</option>
                                <option value="2">★★</option>
                                <option value="1">★</option>
                            </select>
                        </div>
                        <textarea name="comment" rows="2" class="w-full border rounded px-3 py-2 mb-2" placeholder="Write your review..." required></textarea>
                        @error('comment') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        <button type="submit" class="bg-red-600 text-white px-4 py-1 rounded text-sm hover:bg-red-700">Post Review</button>
                    </form>
                    @elseif($existingReview)
                    <form action="{{ route('reviews.update', $existingReview) }}" method="POST" class="bg-blue-50 rounded p-4 mb-4">
                        @csrf @method('PUT')
                        <p class="text-sm text-blue-600 mb-2">Update your review:</p>
                        <select name="rating" class="border rounded px-2 py-1 mb-2">
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ $existingReview->rating == $i ? 'selected' : '' }}>{{ str_repeat('★', $i) }}</option>
                            @endfor
                        </select>
                        <textarea name="comment" rows="2" class="w-full border rounded px-3 py-2 mb-2">{{ $existingReview->comment }}</textarea>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded text-sm hover:bg-blue-700">Update Review</button>
                    </form>
                    @endif
                @endauth
                @foreach($flower->reviews()->with('user')->latest()->get() as $review)
                <div class="border-b py-3">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-medium text-sm">{{ $review->user->name }}</span>
                        <span class="text-yellow-400 text-sm">{{ str_repeat('★', $review->rating) }}</span>
                        <span class="text-gray-400 text-xs">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-gray-700">{{ $review->comment }}</p>
                </div>
                @endforeach
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