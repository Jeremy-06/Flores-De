@extends('layouts.app')

@section('title', 'Order ' . $order->order_number)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <a href="{{ route('orders.index') }}" class="text-gray-400 hover:text-rose-500 text-sm flex items-center gap-1 mb-3 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                Back to Orders
            </a>
            <h1 class="text-3xl font-display font-bold text-gray-800">Order Details</h1>
        </div>
        <span class="px-4 py-1.5 rounded-full text-sm font-bold
            @if($order->status === 'delivered') bg-emerald-50 text-emerald-600 ring-1 ring-emerald-200
            @elseif($order->status === 'cancelled') bg-red-50 text-red-600 ring-1 ring-red-200
            @elseif($order->status === 'processing') bg-blue-50 text-blue-600 ring-1 ring-blue-200
            @else bg-amber-50 text-amber-600 ring-1 ring-amber-200
            @endif">
            {{ ucfirst($order->status) }}
        </span>
    </div>

    <!-- Order Info & Delivery Grid -->
    <div class="grid md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm p-6">
            <h2 class="font-display font-bold text-gray-800 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-gradient-to-br from-rose-100 to-pink-100 rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                </span>
                Order Information
            </h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between"><span class="text-gray-400">Order Number</span><span class="font-semibold text-gray-700">{{ $order->order_number }}</span></div>
                <div class="flex justify-between"><span class="text-gray-400">Date</span><span class="font-semibold text-gray-700">{{ $order->created_at->format('M d, Y h:i A') }}</span></div>
                <div class="flex justify-between"><span class="text-gray-400">Total</span><span class="font-bold gradient-text text-lg">₱{{ number_format($order->total, 2) }}</span></div>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm p-6">
            <h2 class="font-display font-bold text-gray-800 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-gradient-to-br from-rose-100 to-pink-100 rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                </span>
                Delivery Details
            </h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between"><span class="text-gray-400">Recipient</span><span class="font-semibold text-gray-700">{{ $order->customer_name }}</span></div>
                <div class="flex justify-between"><span class="text-gray-400">Phone</span><span class="font-semibold text-gray-700">{{ $order->customer_phone }}</span></div>
                <div class="flex justify-between"><span class="text-gray-400">Delivery Date</span><span class="font-semibold text-gray-700">{{ $order->delivery_date->format('M d, Y') }}</span></div>
                <div><span class="text-gray-400 block mb-1">Address</span><span class="font-semibold text-gray-700">{{ $order->delivery_address }}</span></div>
            </div>
        </div>
    </div>

    @if($order->message)
        <div class="bg-gradient-to-br from-rose-50 to-pink-50 rounded-2xl p-6 mb-6 border border-rose-100/50">
            <h3 class="font-display font-bold text-gray-800 mb-2 flex items-center gap-2">
                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                Card Message
            </h3>
            <p class="italic text-gray-600 text-sm leading-relaxed">"{{ $order->message }}"</p>
        </div>
    @endif

    <!-- Order Items -->
    <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-rose-100/50">
            <h2 class="font-display font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
                Order Items
            </h2>
        </div>
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gradient-to-r from-rose-50 to-pink-50">
                    <th class="text-left px-6 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Flower</th>
                    <th class="text-center px-6 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Qty</th>
                    <th class="text-right px-6 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Price</th>
                    <th class="text-right px-6 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-rose-50">
                @foreach($order->items as $item)
                    <tr class="hover:bg-rose-50/30 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $item->flower_name }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 bg-rose-50 rounded-lg text-rose-600 text-xs font-bold">{{ $item->quantity }}</span>
                        </td>
                        <td class="px-6 py-4 text-right text-gray-500">₱{{ number_format($item->price, 2) }}</td>
                        <td class="px-6 py-4 text-right font-semibold text-gray-700">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gradient-to-r from-rose-50 to-pink-50">
                    <td colspan="3" class="text-right px-6 py-4 font-display font-bold text-gray-800">Total</td>
                    <td class="text-right px-6 py-4 font-bold gradient-text text-xl">₱{{ number_format($order->total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection