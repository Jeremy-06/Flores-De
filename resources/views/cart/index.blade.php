@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Your Cart</h1>

    @if($cartItems->count() > 0)
        <div class="lg:flex gap-8">
            <!-- Cart Items -->
            <div class="flex-1">
                <div class="bg-white border border-gray-200 rounded overflow-hidden">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-pink-50 border-b">
                                <th class="px-4 py-3 text-left text-gray-600">Product</th>
                                <th class="px-4 py-3 text-center text-gray-600">Quantity</th>
                                <th class="px-4 py-3 text-right text-gray-600">Price</th>
                                <th class="px-4 py-3 text-right text-gray-600">Subtotal</th>
                                <th class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($cartItems as $item)
                                <tr>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $item->attributes->image ? asset('storage/' . $item->attributes->image) : 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=80&h=80&fit=crop' }}" alt="{{ $item->name }}" class="w-14 h-14 object-cover rounded">
                                            <a href="{{ route('shop.show', $item->attributes->slug) }}" class="font-semibold text-gray-800 hover:text-red-600">
                                                {{ $item->name }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex justify-center items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="border border-gray-300 rounded w-16 text-center text-sm py-1 focus:border-red-500 focus:ring-red-500">
                                            <button type="submit" class="text-red-600 hover:underline text-xs">Update</button>
                                        </form>
                                    </td>
                                    <td class="px-4 py-4 text-right text-gray-500">₱{{ number_format($item->price, 2) }}</td>
                                    <td class="px-4 py-4 text-right font-bold text-red-600">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                                    <td class="px-4 py-4 text-right">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-xs">Remove</button>
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
                        <button type="submit" class="text-red-600 hover:underline text-sm">Clear Cart</button>
                    </form>
                    <a href="{{ route('shop.index') }}" class="text-red-600 hover:underline text-sm">&larr; Continue Shopping</a>
                </div>
            </div>

            <!-- Summary -->
            <div class="lg:w-72 mt-6 lg:mt-0">
                <div class="bg-white border border-gray-200 rounded p-5">
                    <h2 class="font-bold text-gray-800 mb-4">Order Summary</h2>

                    <div class="space-y-2 mb-4">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">{{ $item->name }} ×{{ $item->quantity }}</span>
                                <span class="text-gray-700">₱{{ number_format($item->price * $item->quantity, 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t pt-3 mb-4">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-800">Total</span>
                            <span class="text-xl font-bold text-red-600">₱{{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="block w-full text-center bg-red-600 text-white py-3 rounded font-semibold hover:bg-red-700">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white border border-gray-200 rounded p-12 text-center max-w-md mx-auto">
            <p class="text-gray-500 mb-4">Your cart is empty.</p>
            <a href="{{ route('shop.index') }}" class="inline-block bg-red-600 text-white px-6 py-2 rounded font-semibold hover:bg-red-700">Start Shopping</a>
        </div>
    @endif
</div>
@endsection