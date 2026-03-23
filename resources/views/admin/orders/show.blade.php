@extends('layouts.app')
@section('title', 'Order #' . $order->id)

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

    <a href="{{ route('admin.orders.index') }}" class="text-pink-600 hover:underline text-sm mb-4 inline-block">&larr; Back to Orders</a>

    <!-- Order Info -->
    <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Order Details</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div class="space-y-2">
                <p><span class="text-gray-500">Customer:</span> <span class="font-semibold">{{ $order->user->name ?? 'N/A' }}</span></p>
                <p><span class="text-gray-500">Email:</span> <span class="font-semibold">{{ $order->user->email ?? 'N/A' }}</span></p>
                <p><span class="text-gray-500">Phone:</span> <span class="font-semibold">{{ $order->phone ?? $order->customer_phone ?? 'N/A' }}</span></p>
                <p><span class="text-gray-500">Address:</span> <span class="font-semibold">{{ $order->delivery_address ?? 'N/A' }}</span></p>
            </div>
            <div class="space-y-2">
                <p><span class="text-gray-500">Order Date:</span> <span class="font-semibold">{{ $order->created_at->format('M d, Y h:i A') }}</span></p>
                <p><span class="text-gray-500">Delivery Date:</span> <span class="font-semibold">{{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('M d, Y') : 'N/A' }}</span></p>
                <p>
                    <span class="text-gray-500">Status:</span>
                    <span class="px-2 py-0.5 rounded text-xs font-semibold
                        @if($order->status === 'pending') bg-yellow-100 text-yellow-700
                        @elseif($order->status === 'processing') bg-blue-100 text-blue-700
                        @elseif($order->status === 'delivered') bg-green-100 text-green-700
                        @elseif($order->status === 'cancelled') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-700
                        @endif">{{ ucfirst($order->status) }}</span>
                </p>
                <p><span class="text-gray-500">Total:</span> <span class="font-bold text-pink-600">₱{{ number_format($order->total ?? $order->total_amount ?? 0, 2) }}</span></p>
            </div>
        </div>

        @if($order->message)
            <div class="mt-4 bg-pink-50 rounded-lg p-3">
                <p class="text-sm text-gray-500 mb-1">Card Message:</p>
                <p class="text-sm italic text-gray-700">"{{ $order->message }}"</p>
            </div>
        @endif
    </div>

    <!-- Order Items -->
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden mb-6">
        <div class="p-4 border-b border-gray-100">
            <h3 class="text-sm font-bold text-gray-800">Order Items</h3>
        </div>
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-pink-50 border-b border-gray-200">
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Flower</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($order->items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $item->flower_name }}</td>
                        <td class="px-4 py-3 text-gray-600">₱{{ number_format($item->price, 2) }}</td>
                        <td class="px-4 py-3">{{ $item->quantity }}</td>
                        <td class="px-4 py-3 font-semibold">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-pink-50 border-t border-gray-200">
                    <td colspan="3" class="px-4 py-3 text-right font-bold text-gray-800">Total:</td>
                    <td class="px-4 py-3 font-bold text-pink-600">₱{{ number_format($order->total ?? $order->total_amount ?? 0, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Update Status -->
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h3 class="text-sm font-bold text-gray-800 mb-4">Update Status</h3>

        <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="flex items-center gap-4">
            @csrf
            @method('PUT')

            <select name="status" class="border border-gray-300 rounded px-3 py-2 text-sm focus:border-pink-500 focus:ring-pink-500">
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-pink-700">
                Update Status
            </button>
        </form>
    </div>

</div>
@endsection