@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="fd-container py-4 md:py-8">
    <h1 class="text-3xl font-bold mb-6" style="font-family: 'Playfair Display', serif;">Checkout</h1>

    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <form action="{{ route('checkout.process') }}" method="POST" class="fd-panel p-6">
                @csrf

                <h2 class="font-bold text-lg text-slate-800 mb-4">Delivery Information</h2>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-slate-600 mb-1">Recipient Name *</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" required class="fd-input">
                            @error('customer_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-slate-600 mb-1">Phone Number *</label>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone', auth()->user()->phone) }}" required class="fd-input">
                            @error('customer_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-slate-600 mb-1">Delivery Address *</label>
                        <textarea name="delivery_address" rows="3" required class="fd-textarea" placeholder="Enter complete delivery address...">{{ old('delivery_address') }}</textarea>
                        @error('delivery_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-slate-600 mb-1">Delivery Timeline</label>
                        <div class="fd-panel-soft p-3 text-sm text-slate-700 space-y-1">
                            <p><span class="text-slate-500">Order Date:</span> {{ now()->format('M d, Y') }}</p>
                            <p><span class="text-slate-500">Guaranteed to Get By:</span> <span class="font-semibold">{{ now()->addDays(5)->format('M d, Y') }}</span></p>
                            <p class="text-xs text-slate-500">Estimated delivery is automatically set to 5 days after your order date.</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-slate-600 mb-1">Card Message (Optional)</label>
                        <textarea name="message" rows="3" placeholder="Write a personal message for the recipient..." class="fd-textarea">{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <button type="submit" class="w-full fd-btn-primary py-3 mt-6">
                    Place Order
                </button>
            </form>
        </div>

        <div>
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

                <div class="border-t border-orange-100 pt-3">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-slate-800">Total</span>
                        <span class="text-2xl font-extrabold text-orange-700">₱{{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection