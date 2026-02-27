@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-display font-bold text-gray-800 flex items-center gap-3">
            <span class="w-10 h-10 bg-gradient-to-br from-rose-100 to-pink-100 rounded-2xl flex items-center justify-center">
                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
            </span>
            Your Cart
        </h1>
    </div>

    @if($cartItems->count() > 0)
        <div class="lg:flex gap-8">
            <!-- Cart Items -->
            <div class="flex-1">
                <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm overflow-hidden">
                    <!-- Desktop Table -->
                    <div class="hidden md:block">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gradient-to-r from-rose-50 to-pink-50 border-b border-rose-100/50">
                                    <th class="px-6 py-4 text-left font-semibold text-gray-600 text-xs uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-4 text-center font-semibold text-gray-600 text-xs uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-4 text-right font-semibold text-gray-600 text-xs uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-4 text-right font-semibold text-gray-600 text-xs uppercase tracking-wider">Subtotal</th>
                                    <th class="px-6 py-4"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-rose-50">
                                @foreach($cartItems as $item)
                                    <tr class="hover:bg-rose-50/30 transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-4">
                                                <img src="{{ $item->attributes->image ? asset('storage/' . $item->attributes->image) : 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=80&h=80&fit=crop' }}" alt="{{ $item->name }}" class="w-16 h-16 object-cover rounded-xl border border-rose-100/50 shadow-sm">
                                                <a href="{{ route('shop.show', $item->attributes->slug) }}" class="font-semibold text-gray-800 hover:text-rose-600 transition-colors">
                                                    {{ $item->name }}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex justify-center items-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="input-elegant w-16 text-center text-sm py-1.5">
                                                <button type="submit" class="text-rose-500 hover:text-rose-700 text-xs font-semibold transition-colors">Update</button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-5 text-right text-gray-500">₱{{ number_format($item->price, 2) }}</td>
                                        <td class="px-6 py-5 text-right font-bold gradient-text">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                                        <td class="px-6 py-5 text-right">
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="md:hidden divide-y divide-rose-50">
                        @foreach($cartItems as $item)
                            <div class="p-5">
                                <div class="flex items-center gap-4 mb-3">
                                    <img src="{{ $item->attributes->image ? asset('storage/' . $item->attributes->image) : 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=80&h=80&fit=crop' }}" alt="{{ $item->name }}" class="w-16 h-16 object-cover rounded-xl shadow-sm">
                                    <div class="flex-1">
                                        <a href="{{ route('shop.show', $item->attributes->slug) }}" class="font-semibold text-gray-800 text-sm">{{ $item->name }}</a>
                                        <p class="text-rose-500 font-bold mt-1">₱{{ number_format($item->price * $item->quantity, 2) }}</p>
                                    </div>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                                    </form>
                                </div>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="input-elegant w-16 text-center text-sm py-1.5">
                                    <button type="submit" class="text-rose-500 text-xs font-semibold">Update</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-between">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-500 text-sm font-medium flex items-center gap-1.5 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                            Clear Cart
                        </button>
                    </form>
                    <a href="{{ route('shop.index') }}" class="text-rose-600 hover:text-rose-700 text-sm font-medium flex items-center gap-1.5 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                        Continue Shopping
                    </a>
                </div>
            </div>

            <!-- Summary -->
            <div class="lg:w-80 mt-6 lg:mt-0">
                <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm p-6 sticky top-24">
                    <h2 class="font-display font-bold text-gray-800 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z"/></svg>
                        Order Summary
                    </h2>

                    <div class="space-y-3 mb-5">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">{{ $item->name }} <span class="text-gray-400">×{{ $item->quantity }}</span></span>
                                <span class="font-medium text-gray-700">₱{{ number_format($item->price * $item->quantity, 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-rose-100 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-display font-bold text-gray-800">Total</span>
                            <span class="text-2xl font-bold gradient-text">₱{{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn-primary w-full py-3.5 text-sm flex items-center justify-center gap-2">
                        Proceed to Checkout
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>

                    <!-- Trust Badges -->
                    <div class="mt-5 pt-5 border-t border-rose-100 space-y-2.5">
                        <p class="text-gray-400 text-xs flex items-center gap-2">
                            <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                            Secure checkout
                        </p>
                        <p class="text-gray-400 text-xs flex items-center gap-2">
                            <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                            Free delivery over ₱2,000
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="bg-white rounded-3xl border border-rose-100/50 shadow-sm p-16 text-center max-w-lg mx-auto">
            <div class="w-24 h-24 bg-gradient-to-br from-rose-50 to-pink-50 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-rose-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
            </div>
            <h2 class="font-display font-bold text-xl text-gray-700 mb-2">Your cart is empty</h2>
            <p class="text-gray-400 text-sm mb-8">Looks like you haven't added any flowers yet</p>
            <a href="{{ route('shop.index') }}" class="btn-primary inline-flex items-center gap-2 px-8 py-3 text-sm">
                Start Shopping
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>
    @endif
</div>
@endsection