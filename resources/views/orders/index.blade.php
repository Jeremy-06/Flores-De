@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-display font-bold text-gray-800 flex items-center gap-3">
            <span class="w-10 h-10 bg-gradient-to-br from-rose-100 to-pink-100 rounded-2xl flex items-center justify-center">
                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
            </span>
            My Orders
        </h1>
        <p class="text-gray-400 mt-2 text-sm">Track and manage all your flower orders</p>
    </div>

    @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
                <a href="{{ route('orders.show', $order) }}" class="group block bg-white rounded-2xl border border-rose-100/50 shadow-sm hover:shadow-lg hover:shadow-rose-500/10 hover:border-rose-200 p-6 transition-all duration-300 hover:-translate-y-0.5">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-rose-50 to-pink-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-rose-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
                            </div>
                            <div>
                                <p class="font-display font-bold text-gray-800">{{ $order->order_number }}</p>
                                <p class="text-gray-400 text-xs mt-0.5">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 sm:gap-6">
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                @if($order->status === 'delivered') bg-emerald-50 text-emerald-600 ring-1 ring-emerald-200
                                @elseif($order->status === 'cancelled') bg-red-50 text-red-600 ring-1 ring-red-200
                                @elseif($order->status === 'processing') bg-blue-50 text-blue-600 ring-1 ring-blue-200
                                @else bg-amber-50 text-amber-600 ring-1 ring-amber-200
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                            <span class="font-bold gradient-text text-lg">₱{{ number_format($order->total, 2) }}</span>
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-rose-400 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $orders->links() }}
        </div>
    @else
        <div class="bg-white rounded-3xl border border-rose-100/50 shadow-sm p-16 text-center max-w-lg mx-auto">
            <div class="w-24 h-24 bg-gradient-to-br from-rose-50 to-pink-50 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-rose-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
            </div>
            <h2 class="font-display font-bold text-xl text-gray-700 mb-2">No orders yet</h2>
            <p class="text-gray-400 text-sm mb-8">Your beautiful flower orders will appear here</p>
            <a href="{{ route('shop.index') }}" class="btn-primary inline-flex items-center gap-2 px-8 py-3 text-sm">
                Start Shopping
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>
    @endif
</div>
@endsection