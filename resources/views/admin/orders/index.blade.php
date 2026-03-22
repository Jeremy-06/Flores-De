@extends('layouts.app')
@section('title', 'Manage Orders')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6">Manage Orders</h1>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded text-sm mb-4">{{ session('success') }}</div>
    @endif

    <!-- Filters -->
    <div class="bg-white border border-gray-200 rounded-lg p-4 mb-6">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="text-xs font-medium text-gray-500 block mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Order # or customer name..."
                       class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500">
            </div>
            <div>
                <label class="text-xs font-medium text-gray-500 block mb-1">Status</label>
                <select name="status" class="border border-gray-300 rounded px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500">
                    <option value="">All</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded text-sm hover:bg-red-700">Filter</button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.orders.index') }}" class="text-gray-500 text-sm hover:underline py-2">Clear</a>
            @endif
        </form>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order #</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm text-gray-500">{{ $order->id }}</td>
                    <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $order->order_number }}</td>
                    <td class="px-4 py-3 text-sm">{{ $order->user->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-sm font-medium">₱{{ number_format((float) $order->total, 2) }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded-full font-medium
                            @if($order->status === 'delivered') bg-green-100 text-green-700
                            @elseif($order->status === 'cancelled') bg-red-100 text-red-700
                            @elseif($order->status === 'processing') bg-blue-100 text-blue-700
                            @else bg-yellow-100 text-yellow-700
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-red-600 hover:underline text-sm font-medium">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">No orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $orders->links() }}</div>
</div>
@endsection