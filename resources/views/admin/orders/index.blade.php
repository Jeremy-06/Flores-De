@extends('layouts.app')
@section('title', 'Manage Orders')

@section('content')
<div class="fd-container py-4 md:py-6">
    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="fd-link text-sm font-semibold">&larr; Back to Admin</a>
    </div>
    <h1 class="text-3xl font-bold mb-6" style="font-family: 'Playfair Display', serif;">Manage Orders</h1>

    <!-- Filters -->
    <div class="fd-panel p-4 mb-6">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="text-xs font-medium text-slate-500 block mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Order # or customer name..."
                       class="fd-input">
            </div>
            <div>
                <label class="text-xs font-medium text-slate-500 block mb-1">Status</label>
                <select name="status" class="fd-select">
                    <option value="">All</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="fd-btn-primary text-sm">Filter</button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.orders.index') }}" class="text-slate-500 text-sm hover:underline py-2">Clear</a>
            @endif
        </form>
    </div>

    <!-- Orders Table -->
    <div class="fd-panel overflow-hidden">
        <table class="fd-table min-w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="text-sm text-slate-500">{{ $order->id }}</td>
                    <td class="text-sm font-medium text-slate-800">{{ $order->order_number }}</td>
                    <td class="text-sm">{{ $order->user->name ?? 'N/A' }}</td>
                    <td class="text-sm font-semibold text-orange-700">₱{{ number_format((float) $order->total, 2) }}</td>
                    <td>
                        <span class="@if($order->status === 'delivered') fd-status-ok @elseif($order->status === 'cancelled') fd-status-danger @elseif($order->status === 'processing') fd-status-info @else fd-status-warn @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="text-sm text-slate-500">{{ $order->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="fd-link hover:underline text-sm font-medium">View</a>
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