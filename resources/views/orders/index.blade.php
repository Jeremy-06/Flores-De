@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">My Orders</h1>

    @if($orders->count() > 0)
        <div class="bg-white border border-gray-200 rounded overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-pink-50 border-b">
                        <th class="px-4 py-3 text-left text-gray-600">Order Number</th>
                        <th class="px-4 py-3 text-left text-gray-600">Date</th>
                        <th class="px-4 py-3 text-left text-gray-600">Status</th>
                        <th class="px-4 py-3 text-right text-gray-600">Total</th>
                        <th class="px-4 py-3 text-right text-gray-600"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($orders as $order)
                        <tr>
                            <td class="px-4 py-3 font-semibold text-gray-800">{{ $order->order_number }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $order->created_at->format('M d, Y h:i A') }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold
                                    @if($order->status === 'delivered') bg-green-100 text-green-700
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-700
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-700
                                    @else bg-yellow-100 text-yellow-700
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right font-bold text-red-600">₱{{ number_format($order->total, 2) }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('orders.show', $order) }}" class="text-red-600 hover:underline text-sm">View</a>
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
        <div class="bg-white border border-gray-200 rounded p-12 text-center max-w-md mx-auto">
            <p class="text-gray-500 mb-4">No orders yet.</p>
            <a href="{{ route('shop.index') }}" class="inline-block bg-red-600 text-white px-6 py-2 rounded font-semibold hover:bg-red-700">Start Shopping</a>
        </div>
    @endif
</div>
@endsection