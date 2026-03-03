<div class="bg-white border border-gray-200 rounded overflow-hidden">
    <a href="{{ route('shop.show', $flower->slug) }}" class="block">
        @if($flower->image)
            <img src="{{ asset('storage/' . $flower->image) }}" alt="{{ $flower->name }}" class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
        @endif
    </a>
    <div class="p-4">
        <p class="text-xs text-gray-500 mb-1">{{ $flower->category->name }}</p>
        <a href="{{ route('shop.show', $flower->slug) }}" class="font-semibold text-gray-800 hover:text-red-600 block mb-2">
            {{ $flower->name }}
        </a>
        <div class="flex items-center justify-between">
            <span class="text-red-600 font-bold">₱{{ number_format($flower->price, 2) }}</span>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="flower_id" value="{{ $flower->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-xs font-semibold hover:bg-red-700">
                    Add to Cart
                </button>
            </form>
        </div>
    </div>
</div>