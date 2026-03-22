@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    <h1 class="text-lg font-bold mb-5 text-gray-800">Admin Dashboard</h1>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <div class="border border-gray-200 rounded p-4 text-center">
            <p class="text-2xl font-bold text-red-600">{{ $stats['total_flowers'] }}</p>
            <p class="text-gray-500 text-xs">Flowers</p>
        </div>
        <div class="border border-gray-200 rounded p-4 text-center">
            <p class="text-2xl font-bold text-red-600">{{ $stats['total_orders'] }}</p>
            <p class="text-gray-500 text-xs">Orders</p>
        </div>
        <div class="border border-gray-200 rounded p-4 text-center">
            <p class="text-2xl font-bold text-red-600">{{ $stats['total_customers'] }}</p>
            <p class="text-gray-500 text-xs">Customers</p>
        </div>
        <div class="border border-gray-200 rounded p-4 text-center">
            <p class="text-2xl font-bold text-green-600">₱{{ number_format($stats['total_revenue'], 2) }}</p>
            <p class="text-gray-500 text-xs">Revenue</p>
        </div>
        <div class="border border-gray-200 rounded p-4 text-center">
            <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending_orders'] }}</p>
            <p class="text-gray-500 text-xs">Pending</p>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <a href="{{ route('admin.categories.index') }}" class="border border-gray-200 rounded p-4 text-center hover:bg-pink-50">
            <svg class="w-6 h-6 mx-auto mb-2 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/></svg>
            <p class="text-sm font-medium">Categories</p>
        </a>
        <a href="{{ route('admin.flowers.index') }}" class="border border-gray-200 rounded p-4 text-center hover:bg-pink-50">
            <svg class="w-6 h-6 mx-auto mb-2 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            <p class="text-sm font-medium">Flowers</p>
        </a>
        <a href="{{ route('admin.orders.index') }}" class="border border-gray-200 rounded p-4 text-center hover:bg-pink-50">
            <svg class="w-6 h-6 mx-auto mb-2 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
            <p class="text-sm font-medium">Orders</p>
        </a>
        <a href="{{ route('admin.users.index') }}" class="border border-gray-200 rounded p-4 text-center hover:bg-pink-50">
            <svg class="w-6 h-6 mx-auto mb-2 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            <p class="text-sm font-medium">Users</p>
        </a>
        <a href="{{ route('admin.reviews.index') }}" class="border border-gray-200 rounded p-4 text-center hover:bg-pink-50">
            <svg class="w-6 h-6 mx-auto mb-2 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
            <p class="text-sm font-medium">Reviews</p>
        </a>
        <a href="{{ route('admin.flowers.create') }}" class="bg-red-600 text-white rounded p-4 text-center hover:bg-red-700">
            <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            <p class="text-sm font-medium">Add Flower</p>
        </a>
    </div>

    <!-- Recent Orders -->
    <div class="border border-gray-200 rounded p-4">
        <h2 class="text-sm font-bold mb-3 text-red-600">Recent Orders</h2>
        <table class="w-full text-sm">
            <thead class="border-b">
                <tr>
                    <th class="text-left py-2 font-medium">Order</th>
                    <th class="text-left py-2 font-medium">Customer</th>
                    <th class="text-center py-2 font-medium">Status</th>
                    <th class="text-right py-2 font-medium">Total</th>
                    <th class="text-right py-2 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                    <tr class="border-b border-gray-100">
                        <td class="py-2">{{ $order->order_number }}</td>
                        <td class="py-2">{{ $order->user->name }}</td>
                        <td class="py-2 text-center">
                            <span class="px-2 py-0.5 rounded text-xs font-medium
                                @if($order->status === 'delivered') bg-green-100 text-green-700
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-700
                                @elseif($order->status === 'processing') bg-blue-100 text-blue-700
                                @else bg-yellow-100 text-yellow-700
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="py-2 text-right">₱{{ number_format($order->total, 2) }}</td>
                        <td class="py-2 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-red-600 hover:underline text-xs">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection