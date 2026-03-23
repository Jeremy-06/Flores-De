@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="fd-container py-4 md:py-8">
    <h1 class="text-3xl font-bold mb-6" style="font-family: 'Playfair Display', serif;">My Orders</h1>

    @if($orders->count() > 0)
        <div class="fd-panel overflow-hidden">
            <table class="fd-table">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-right">Total</th>
                        <th class="text-right"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="font-semibold text-slate-800">{{ $order->order_number }}</td>
                            <td class="text-slate-500">{{ $order->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                                <span class="@if($order->status === 'delivered') fd-status-ok @elseif($order->status === 'cancelled') fd-status-danger @elseif($order->status === 'processing') fd-status-info @else fd-status-warn @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="text-right font-bold text-orange-700">₱{{ number_format($order->total, 2) }}</td>
                            <td class="text-right">
                                @php
                                    $reviewItem = $order->items->first(fn($item) => $item->flower);
                                @endphp
                                <div class="flex justify-end gap-2 flex-wrap">
                                    <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center justify-center rounded-lg px-3 py-1.5 text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200 whitespace-nowrap">View</a>
                                    @if($order->status === 'delivered' && $reviewItem)
                                        <a href="{{ route('shop.show', $reviewItem->flower->slug) }}#customer-reviews" class="inline-flex items-center justify-center rounded-lg px-3 py-1.5 text-xs font-semibold bg-blue-600 text-white hover:bg-blue-700 whitespace-nowrap">Proceed to Review</a>
                                    @elseif($order->status === 'delivered')
                                        <a href="{{ route('orders.show', $order) }}#review-links" class="inline-flex items-center justify-center rounded-lg px-3 py-1.5 text-xs font-semibold bg-blue-600 text-white hover:bg-blue-700 whitespace-nowrap">Proceed to Review</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @else
        <div class="fd-panel p-12 text-center max-w-md mx-auto">
            <svg class="w-16 h-16 mx-auto mb-4 text-orange-200" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
            <p class="text-slate-500 mb-4">No orders yet.</p>
            <a href="{{ route('shop.index') }}" class="inline-block fd-btn-primary">Start Shopping</a>
        </div>
    @endif
</div>
@endsection