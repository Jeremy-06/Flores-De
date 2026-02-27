@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-display font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-400 mt-1 text-sm">Welcome back! Here's what's happening with your store.</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <span class="w-10 h-10 bg-gradient-to-br from-rose-100 to-pink-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-rose-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </span>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_flowers'] }}</p>
            <p class="text-gray-400 text-xs mt-0.5">Total Flowers</p>
        </div>
        <div class="bg-white rounded-2xl border border-blue-100/50 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <span class="w-10 h-10 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
                </span>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_orders'] }}</p>
            <p class="text-gray-400 text-xs mt-0.5">Total Orders</p>
        </div>
        <div class="bg-white rounded-2xl border border-violet-100/50 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <span class="w-10 h-10 bg-gradient-to-br from-violet-100 to-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                </span>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_customers'] }}</p>
            <p class="text-gray-400 text-xs mt-0.5">Customers</p>
        </div>
        <div class="bg-white rounded-2xl border border-emerald-100/50 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <span class="w-10 h-10 bg-gradient-to-br from-emerald-100 to-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
            <p class="text-2xl font-bold text-emerald-600">₱{{ number_format($stats['total_revenue'], 2) }}</p>
            <p class="text-gray-400 text-xs mt-0.5">Revenue</p>
        </div>
        <div class="bg-white rounded-2xl border border-amber-100/50 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <span class="w-10 h-10 bg-gradient-to-br from-amber-100 to-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
            <p class="text-2xl font-bold text-amber-600">{{ $stats['pending_orders'] }}</p>
            <p class="text-gray-400 text-xs mt-0.5">Pending</p>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('admin.categories.index') }}" class="group bg-white rounded-2xl border border-rose-100/50 shadow-sm p-6 text-center hover:shadow-lg hover:shadow-rose-500/10 hover:-translate-y-1 transition-all duration-300">
            <div class="w-14 h-14 bg-gradient-to-br from-rose-50 to-pink-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:from-rose-100 group-hover:to-pink-100 group-hover:scale-110 transition-all duration-300">
                <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/></svg>
            </div>
            <p class="font-semibold text-gray-700 group-hover:text-rose-600 transition-colors">Categories</p>
        </a>
        <a href="{{ route('admin.flowers.index') }}" class="group bg-white rounded-2xl border border-rose-100/50 shadow-sm p-6 text-center hover:shadow-lg hover:shadow-rose-500/10 hover:-translate-y-1 transition-all duration-300">
            <div class="w-14 h-14 bg-gradient-to-br from-rose-50 to-pink-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:from-rose-100 group-hover:to-pink-100 group-hover:scale-110 transition-all duration-300">
                <svg class="w-6 h-6 text-rose-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </div>
            <p class="font-semibold text-gray-700 group-hover:text-rose-600 transition-colors">Flowers</p>
        </a>
        <a href="{{ route('admin.orders.index') }}" class="group bg-white rounded-2xl border border-rose-100/50 shadow-sm p-6 text-center hover:shadow-lg hover:shadow-rose-500/10 hover:-translate-y-1 transition-all duration-300">
            <div class="w-14 h-14 bg-gradient-to-br from-rose-50 to-pink-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:from-rose-100 group-hover:to-pink-100 group-hover:scale-110 transition-all duration-300">
                <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
            </div>
            <p class="font-semibold text-gray-700 group-hover:text-rose-600 transition-colors">Orders</p>
        </a>
        <a href="{{ route('admin.flowers.create') }}" class="group bg-gradient-to-br from-rose-500 to-pink-500 rounded-2xl shadow-lg shadow-rose-500/25 p-6 text-center hover:shadow-xl hover:shadow-rose-500/30 hover:-translate-y-1 transition-all duration-300">
            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-white/30 group-hover:scale-110 transition-all duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            </div>
            <p class="font-semibold text-white">Add Flower</p>
        </a>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-rose-100/50 flex items-center justify-between">
            <h2 class="font-display font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Recent Orders
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="text-rose-500 hover:text-rose-600 text-sm font-medium flex items-center gap-1 transition-colors">
                View All
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            </a>
        </div>
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gradient-to-r from-rose-50 to-pink-50">
                    <th class="text-left px-6 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Order</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Customer</th>
                    <th class="text-center px-6 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Status</th>
                    <th class="text-right px-6 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Total</th>
                    <th class="text-right px-6 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-rose-50">
                @foreach($recentOrders as $order)
                    <tr class="hover:bg-rose-50/30 transition-colors">
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                @if($order->status === 'delivered') bg-emerald-50 text-emerald-600 ring-1 ring-emerald-200
                                @elseif($order->status === 'cancelled') bg-red-50 text-red-600 ring-1 ring-red-200
                                @elseif($order->status === 'processing') bg-blue-50 text-blue-600 ring-1 ring-blue-200
                                @else bg-amber-50 text-amber-600 ring-1 ring-amber-200
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-bold text-gray-700">₱{{ number_format($order->total, 2) }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center gap-1 text-rose-500 hover:text-rose-600 text-xs font-semibold transition-colors">
                                View
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection