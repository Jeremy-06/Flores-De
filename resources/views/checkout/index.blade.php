@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-display font-bold text-gray-800 flex items-center gap-3">
            <span class="w-10 h-10 bg-gradient-to-br from-rose-100 to-pink-100 rounded-2xl flex items-center justify-center">
                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
            </span>
            Checkout
        </h1>
        <!-- Steps -->
        <div class="flex items-center gap-3 mt-6 text-sm">
            <a href="{{ route('cart.index') }}" class="text-gray-400 hover:text-rose-500 flex items-center gap-1 transition-colors">
                <span class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center text-xs font-bold">1</span>
                Cart
            </a>
            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            <span class="text-rose-600 font-semibold flex items-center gap-1">
                <span class="w-6 h-6 bg-gradient-to-r from-rose-500 to-pink-500 text-white rounded-full flex items-center justify-center text-xs font-bold">2</span>
                Delivery Details
            </span>
            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            <span class="text-gray-400 flex items-center gap-1">
                <span class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center text-xs font-bold">3</span>
                Confirmation
            </span>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Delivery Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('checkout.process') }}" method="POST" class="bg-white rounded-2xl border border-rose-100/50 shadow-sm p-8">
                @csrf

                <h2 class="font-display font-bold text-xl text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                    Delivery Information
                </h2>

                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Recipient Name <span class="text-rose-500">*</span></label>
                            <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" required class="input-elegant w-full">
                            @error('customer_name') <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Phone Number <span class="text-rose-500">*</span></label>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone', auth()->user()->phone) }}" required class="input-elegant w-full">
                            @error('customer_phone') <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1.5">Delivery Address <span class="text-rose-500">*</span></label>
                        <textarea name="delivery_address" rows="3" required class="input-elegant w-full" placeholder="Enter complete delivery address...">{{ old('delivery_address') }}</textarea>
                        @error('delivery_address') <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1.5">Delivery Date <span class="text-rose-500">*</span></label>
                        <input type="date" name="delivery_date" value="{{ old('delivery_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required class="input-elegant w-full">
                        @error('delivery_date') <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1.5">Card Message <span class="text-gray-400 font-normal">(Optional)</span></label>
                        <textarea name="message" rows="3" placeholder="Write a personal message for the recipient..." class="input-elegant w-full">{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full py-4 mt-8 text-sm flex items-center justify-center gap-2 text-base font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Place Order
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div>
            <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm p-6 sticky top-24">
                <h2 class="font-display font-bold text-gray-800 mb-5 flex items-center gap-2">
                    <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z"/></svg>
                    Order Summary
                </h2>

                <div class="space-y-3 mb-5">
                    @foreach($cartItems as $item)
                        <div class="flex items-center gap-3 text-sm">
                            <div class="w-10 h-10 bg-rose-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-rose-400 text-xs font-bold">×{{ $item->quantity }}</span>
                            </div>
                            <span class="text-gray-600 flex-1 truncate">{{ $item->name }}</span>
                            <span class="font-semibold text-gray-700">₱{{ number_format($item->price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-rose-100 pt-4">
                    <div class="flex justify-between items-center">
                        <span class="font-display font-bold text-gray-800">Total</span>
                        <span class="text-2xl font-bold gradient-text">₱{{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <!-- Trust Info -->
                <div class="mt-6 bg-gradient-to-br from-rose-50 to-pink-50 rounded-xl p-4 space-y-2.5">
                    <p class="text-gray-500 text-xs flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                        Free delivery on orders over ₱2,000
                    </p>
                    <p class="text-gray-500 text-xs flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Freshness guaranteed
                    </p>
                    <p class="text-gray-500 text-xs flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                        Cash on delivery
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection