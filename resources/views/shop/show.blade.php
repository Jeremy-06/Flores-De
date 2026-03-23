@extends('layouts.app')

@section('title', $flower->name)

@section('content')
<div class="fd-container py-4 md:py-8">
    <div class="mb-6">
        <a href="{{ route('shop.index') }}" class="fd-link font-semibold text-sm">&larr; Back to Shop</a>
    </div>

    <div class="fd-panel overflow-hidden">
        <div class="lg:flex">
            <div class="lg:w-1/2">
                @if($flower->image)
                    <img id="mainImage" src="{{ asset('storage/' . $flower->image) }}" alt="{{ $flower->name }}" class="w-full h-[400px] object-cover">
                @else
                    <div class="w-full h-[400px] bg-orange-50 flex items-center justify-center">
                        <svg class="w-20 h-20 text-orange-200" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                @endif

                @if($flower->images->count())
                    <div class="flex flex-wrap gap-2 p-4 border-t border-orange-100">
                        @foreach($flower->images as $img)
                            <img src="{{ asset('storage/' . $img->image_path) }}"
                                alt="{{ $flower->name }}"
                                class="w-20 h-20 object-cover rounded-xl cursor-pointer border-2 border-transparent hover:border-orange-500"
                                onclick="document.getElementById('mainImage').src = this.src">
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="lg:w-1/2 p-8">
                <p class="text-xs uppercase tracking-widest text-slate-500 mb-1">
                    <a href="{{ route('shop.category', $flower->category->slug) }}" class="fd-link">{{ $flower->category->name }}</a>
                </p>
                <h1 class="text-3xl font-bold text-slate-800 mb-4" style="font-family: 'Playfair Display', serif;">{{ $flower->name }}</h1>
                <p class="text-3xl font-extrabold text-orange-700 mb-6">₱{{ number_format($flower->price, 2) }}</p>

                <p class="text-slate-600 mb-6 leading-7">{{ $flower->description }}</p>

                @if($flower->stock > 0)
                    <p class="fd-status-ok mb-4">In Stock ({{ $flower->stock }} available)</p>
                    <p class="text-sm text-slate-600 mb-4">Guaranteed to get by <span class="font-semibold">{{ now()->addDays(5)->format('M d, Y') }}</span></p>

                    <form action="{{ route('cart.add') }}" method="POST" class="flex items-end gap-4 mb-6" data-ajax-cart="true">
                        @csrf
                        <input type="hidden" name="flower_id" value="{{ $flower->id }}">
                        <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
                        <div>
                            <label class="text-sm text-slate-600 block mb-1">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $flower->stock }}" class="fd-input w-20 text-center">
                        </div>
                        <button type="submit" class="fd-btn-primary px-6 py-2.5">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <p class="fd-status-danger mb-6">Out of Stock</p>
                @endif
            </div>
        </div>
    </div>

    <div id="customer-reviews" class="mt-8 fd-panel p-6">
        <h3 class="text-xl font-bold mb-4 text-slate-800">Customer Reviews ({{ $flower->reviews->count() }})</h3>
        @auth
            @php
                /** @var \App\Models\Flower $flower */
                $hasBought = auth()->user()->orders()->where('status', 'delivered')
                    ->whereHas('items', fn($q) => $q->where('flower_id', $flower->id))->exists();
                $existingReview = $flower->reviews->where('user_id', auth()->id())->first();
            @endphp
            @if($hasBought && !$existingReview)
            <form action="{{ route('reviews.store') }}" method="POST" class="bg-orange-50 border border-orange-100 rounded-xl p-4 mb-4">
                @csrf
                <input type="hidden" name="flower_id" value="{{ $flower->id }}">
                <div class="mb-2">
                    <label class="text-sm font-medium text-slate-700">Rating</label>
                    <select name="rating" class="fd-select inline-block w-auto ml-2" required>
                        <option value="5">★★★★★</option>
                        <option value="4">★★★★</option>
                        <option value="3">★★★</option>
                        <option value="2">★★</option>
                        <option value="1">★</option>
                    </select>
                </div>
                <textarea name="comment" rows="2" class="fd-textarea mb-2" placeholder="Write your review..." required></textarea>
                @error('comment') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                <button type="submit" class="fd-btn-primary text-sm">Post Review</button>
            </form>
            @elseif($existingReview)
            <form action="{{ route('reviews.update', $existingReview) }}" method="POST" class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-4">
                @csrf @method('PUT')
                <p class="text-sm text-blue-600 mb-2 font-medium">Update your review:</p>
                <select name="rating" class="fd-select mb-2 w-auto">
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ $existingReview->rating == $i ? 'selected' : '' }}>{{ str_repeat('★', $i) }}</option>
                    @endfor
                </select>
                <textarea name="comment" rows="2" class="fd-textarea mb-2">{{ $existingReview->comment }}</textarea>
                <button type="submit" class="inline-flex items-center justify-center gap-2 font-semibold text-white rounded-xl px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700">Update Review</button>
            </form>
            @endif
        @endauth

        @forelse($flower->reviews()->with('user')->latest()->get() as $review)
        <div class="border-b border-orange-100 py-3 last:border-0">
            <div class="flex items-center gap-2 mb-1">
                <span class="font-medium text-sm text-slate-800">{{ $review->user->name }}</span>
                <span class="text-yellow-400 text-sm">{{ str_repeat('★', $review->rating) }}</span>
                <span class="text-slate-400 text-xs">{{ $review->created_at->diffForHumans() }}</span>
            </div>
            <p class="text-sm text-slate-600">{{ $review->comment }}</p>
        </div>
        @empty
        <p class="text-slate-400 text-sm">No reviews yet.</p>
        @endforelse
    </div>

    @if($relatedFlowers->count() > 0)
        <section class="mt-12">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">You May Also Like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5 fd-stagger">
                @foreach($relatedFlowers as $related)
                    @include('components.flower-card', ['flower' => $related])
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection