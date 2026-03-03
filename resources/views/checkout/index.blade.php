@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Checkout</h1>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Delivery Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('checkout.process') }}" method="POST" class="bg-white border border-gray-200 rounded p-6">
                @csrf

                <h2 class="font-bold text-lg text-gray-800 mb-4">Delivery Information</h2>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Recipient Name *</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" required class="border border-gray-300 rounded px-3 py-2 w-full text-sm focus:border-red-500 focus:ring-red-500">
                            @error('customer_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Phone Number *</label>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone', auth()->user()->phone) }}" required class="border border-gray-300 rounded px-3 py-2 w-full text-sm focus:border-red-500 focus:ring-red-500">
                            @error('customer_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Delivery Address *</label>
                        <textarea name="delivery_address" rows="3" required class="border border-gray-300 rounded px-3 py-2 w-full text-sm focus:border-red-500 focus:ring-red-500" placeholder="Enter complete delivery address...">{{ old('delivery_address') }}</textarea>
                        @error('delivery_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Delivery Date *</label>
                        <input type="date" name="delivery_date" value="{{ old('delivery_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required class="border border-gray-300 rounded px-3 py-2 w-full text-sm focus:border-red-500 focus:ring-red-500">
                        @error('delivery_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Card Message (Optional)</label>
                        <textarea name="message" rows="3" placeholder="Write a personal message for the recipient..." class="border border-gray-300 rounded px-3 py-2 w-full text-sm focus:border-red-500 focus:ring-red-500">{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <button type="submit" class="w-full bg-red-600 text-white py-3 rounded font-semibold mt-6 hover:bg-red-700">
                    Place Order
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div>
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

                <div class="border-t pt-3">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-gray-800">Total</span>
                        <span class="text-xl font-bold text-red-600">₱{{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection