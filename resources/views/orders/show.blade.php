@extends('layouts.app')

@section('title', 'Order ' . $order->order_number)

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <a href="{{ route('orders.index') }}" class="text-red-600 hover:underline text-sm mb-4 inline-block">&larr; Back to Orders</a>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Order {{ $order->order_number }}</h1>
        <div class="flex items-center gap-3">
            <a href="{{ route('orders.receipt', $order) }}" class="bg-red-600 text-white px-4 py-1.5 rounded text-sm hover:bg-red-700 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Download Receipt
            </a>
            <span class="px-2 py-0.5 rounded text-xs font-semibold
                @if($order->status === 'delivered') bg-green-100 text-green-700
                @elseif($order->status === 'cancelled') bg-red-100 text-red-700
                @elseif($order->status === 'processing') bg-blue-100 text-blue-700
                @else bg-yellow-100 text-yellow-700
                @endif">
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white border border-gray-200 rounded p-5">
            <h2 class="font-bold text-gray-800 mb-3">Order Information</h2>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">Order Number</span><span class="font-semibold">{{ $order->order_number }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Date</span><span class="font-semibold">{{ $order->created_at->format('M d, Y h:i A') }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Total</span><span class="font-bold text-red-600">₱{{ number_format($order->total, 2) }}</span></div>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded p-5">
            <h2 class="font-bold text-gray-800 mb-3">Delivery Details</h2>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">Recipient</span><span class="font-semibold">{{ $order->customer_name }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Phone</span><span class="font-semibold">{{ $order->customer_phone }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Delivery Date</span><span class="font-semibold">{{ $order->delivery_date->format('M d, Y') }}</span></div>
                <div><span class="text-gray-500 block mb-1">Address</span><span class="font-semibold">{{ $order->delivery_address }}</span></div>
            </div>
        </div>
    </div>

    @if($order->message)
        <div class="bg-pink-50 border border-gray-200 rounded p-5 mb-6">
            <h3 class="font-bold text-gray-800 mb-1">Card Message</h3>
            <p class="italic text-gray-600 text-sm">"{{ $order->message }}"</p>
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-pink-50 border-b">
                    <th class="text-left px-4 py-3 text-gray-600">Flower</th>
                    <th class="text-center px-4 py-3 text-gray-600">Qty</th>
                    <th class="text-right px-4 py-3 text-gray-600">Price</th>
                    <th class="text-right px-4 py-3 text-gray-600">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($order->items as $item)
                    <tr>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $item->flower_name }}</td>
                        <td class="px-4 py-3 text-center">{{ $item->quantity }}</td>
                        <td class="px-4 py-3 text-right text-gray-500">₱{{ number_format($item->price, 2) }}</td>
                        <td class="px-4 py-3 text-right font-semibold">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-pink-50 border-t">
                    <td colspan="3" class="text-right px-4 py-3 font-bold text-gray-800">Total</td>
                    <td class="text-right px-4 py-3 font-bold text-red-600">₱{{ number_format($order->total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection