<div class="group bg-white rounded-2xl overflow-hidden border border-rose-100/50 hover:border-rose-200 shadow-sm hover:shadow-xl hover:shadow-rose-500/10 transition-all duration-500 hover:-translate-y-1">
    <a href="{{ route('shop.show', $flower->slug) }}" class="block relative overflow-hidden">
        @if($flower->image)
            <img 
                src="{{ asset('storage/' . $flower->image) }}" 
                alt="{{ $flower->name }}"
                class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
            >
        @else
            <div class="w-full h-56 bg-gradient-to-br from-rose-50 via-pink-50 to-rose-100 flex items-center justify-center">
                <svg class="w-16 h-16 text-rose-200 group-hover:text-rose-300 group-hover:scale-110 transition-all duration-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
        @endif
        <!-- Overlay on hover -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <!-- Quick view label -->
        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 bg-white/90 backdrop-blur-sm text-rose-600 px-4 py-1.5 rounded-full text-xs font-semibold opacity-0 group-hover:opacity-100 translate-y-3 group-hover:translate-y-0 transition-all duration-500 shadow-lg">
            View Details
        </div>
        <!-- Category badge -->
        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-rose-600 px-3 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase shadow-sm">
            {{ $flower->category->name }}
        </span>
    </a>
    <div class="p-5">
        <a href="{{ route('shop.show', $flower->slug) }}" class="font-display font-bold text-gray-800 hover:text-rose-600 block mb-3 text-[15px] leading-snug transition-colors line-clamp-1">
            {{ $flower->name }}
        </a>
        <div class="flex items-center justify-between">
            <span class="text-lg font-bold gradient-text">₱{{ number_format($flower->price, 2) }}</span>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="flower_id" value="{{ $flower->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="group/btn flex items-center gap-1.5 bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-md shadow-rose-500/25 hover:shadow-lg hover:shadow-rose-500/30 active:scale-95 transition-all duration-300">
                    <svg class="w-3.5 h-3.5 group-hover/btn:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                    Add
                </button>
            </form>
        </div>
    </div>
</div>