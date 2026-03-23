@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="fd-container py-4 md:py-8">
    <h1 class="text-3xl font-bold mb-6" style="font-family: 'Playfair Display', serif;">Your Cart</h1>

    @if($cartItems->count() > 0)
        <div class="lg:flex gap-8">
            <div class="flex-1">
                <div class="fd-panel overflow-hidden">
                    <table class="fd-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $item->attributes->image ? asset('storage/' . $item->attributes->image) : 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=80&h=80&fit=crop' }}" alt="{{ $item->name }}" class="w-14 h-14 object-cover rounded-xl border border-orange-100">
                                            <a href="{{ route('shop.show', $item->attributes->slug) }}" class="font-semibold text-slate-800 hover:text-orange-700">
                                                {{ $item->name }}
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex justify-center items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="fd-input w-16 text-center">
                                            <button type="submit" class="fd-link hover:underline text-xs font-semibold">Update</button>
                                        </form>
                                    </td>
                                    <td class="text-right text-slate-500">₱{{ number_format($item->price, 2) }}</td>
                                    <td class="text-right font-bold text-orange-700">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                                    <td class="text-right">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline text-xs">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 flex items-center justify-between">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline text-sm">Clear Cart</button>
                    </form>
                    <a href="{{ route('shop.index') }}" class="fd-link hover:underline text-sm">&larr; Continue Shopping</a>
                </div>
            </div>

            <div class="lg:w-72 mt-6 lg:mt-0">
                <div class="fd-panel p-5 sticky top-24">
                    <h2 class="font-bold text-slate-800 mb-4">Order Summary</h2>

                    <div class="space-y-2 mb-4">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">{{ $item->name }} ×{{ $item->quantity }}</span>
                                <span class="text-slate-700">₱{{ number_format($item->price * $item->quantity, 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-orange-100 pt-3 mb-4">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-slate-800">Total</span>
                            <span class="text-2xl font-extrabold text-orange-700">₱{{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="block w-full text-center fd-btn-primary py-3">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="fd-panel p-12 text-center max-w-md mx-auto">
            <svg class="w-16 h-16 mx-auto mb-4 text-orange-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            <p class="text-slate-500 mb-4">Your cart is empty.</p>
            <a href="{{ route('shop.index') }}" class="inline-block fd-btn-primary">Start Shopping</a>
        </div>
    @endif
</div>
@endsection