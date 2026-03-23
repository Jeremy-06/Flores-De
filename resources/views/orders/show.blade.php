@extends('layouts.app')

@section('title', 'Order ' . $order->order_number)

@section('content')
<div class="fd-container py-4 md:py-8">
    <a href="{{ route('orders.index') }}" class="fd-link hover:underline text-sm mb-4 inline-block font-semibold">&larr; Back to Orders</a>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Order {{ $order->order_number }}</h1>
        <div class="flex items-center gap-3">
            <a href="{{ route('orders.receipt', $order) }}" class="fd-btn-primary text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Download Receipt
            </a>
            <span class="@if($order->status === 'delivered') fd-status-ok @elseif($order->status === 'cancelled') fd-status-danger @elseif($order->status === 'processing') fd-status-info @else fd-status-warn @endif">
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6 mb-6">
        <div class="fd-panel p-5">
            <h2 class="font-bold text-slate-800 mb-3">Order Information</h2>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-slate-500">Order Number</span><span class="font-semibold">{{ $order->order_number }}</span></div>
                <div class="flex justify-between"><span class="text-slate-500">Order Date</span><span class="font-semibold">{{ $order->created_at->format('M d, Y h:i A') }}</span></div>
                <div class="flex justify-between"><span class="text-slate-500">Total</span><span class="font-bold text-orange-700">₱{{ number_format($order->total, 2) }}</span></div>
            </div>
        </div>
        <div class="fd-panel p-5">
            <h2 class="font-bold text-slate-800 mb-3">Delivery Details</h2>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-slate-500">Recipient</span><span class="font-semibold">{{ $order->customer_name }}</span></div>
                <div class="flex justify-between"><span class="text-slate-500">Phone</span><span class="font-semibold">{{ $order->customer_phone }}</span></div>
                <div class="flex justify-between"><span class="text-slate-500">Guaranteed to Get By</span><span class="font-semibold">{{ ($order->delivery_date ?? $order->created_at->copy()->addDays(5))->format('M d, Y') }}</span></div>
                <div><span class="text-slate-500 block mb-1">Address</span><span class="font-semibold">{{ $order->delivery_address }}</span></div>
            </div>
        </div>
    </div>

    @if($order->message)
        <div class="fd-panel-soft p-5 mb-6">
            <h3 class="font-bold text-slate-800 mb-1">Card Message</h3>
            <p class="italic text-slate-600 text-sm">"{{ $order->message }}"</p>
        </div>
    @endif

    @if($order->status === 'delivered')
        <div id="review-links" class="fd-panel-soft p-5 mb-6">
            <h3 class="font-bold text-slate-800 mb-2">Proceed to Review</h3>
            <p class="text-sm text-slate-600 mb-3">Your order has been delivered. You can now review each flower:</p>
            <div class="flex flex-wrap gap-2">
                @foreach($order->items as $item)
                    @if($item->flower)
                        <a href="{{ route('shop.show', $item->flower->slug) }}#customer-reviews" class="inline-flex items-center justify-center gap-2 font-semibold rounded-xl px-3 py-2 text-xs bg-blue-600 text-white hover:bg-blue-700">
                            Review {{ $item->flower_name }}
                        </a>
                    @else
                        <span class="inline-flex items-center justify-center gap-2 font-semibold rounded-xl px-3 py-2 text-xs bg-slate-200 text-slate-600">
                            {{ $item->flower_name }} (Unavailable)
                        </span>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <div class="fd-panel overflow-hidden">
        <table class="fd-table">
            <thead>
                <tr>
                    <th>Flower</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Price</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td class="font-medium text-slate-800">{{ $item->flower_name }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right text-slate-500">₱{{ number_format($item->price, 2) }}</td>
                        <td class="text-right font-semibold">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right font-bold text-slate-800">Total</td>
                    <td class="text-right font-bold text-orange-700">₱{{ number_format($order->total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection