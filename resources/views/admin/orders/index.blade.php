<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="text-lg font-semibold mb-6">All Orders</h3>

                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-pink-50">
                                <th class="px-4 py-2 text-left">Order #</th>
                                <th class="px-4 py-2 text-left">Customer</th>
                                <th class="px-4 py-2 text-left">Total</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Date</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr class="border-b">
                                    <td class="px-4 py-2">#{{ $order->id }}</td>
                                    <td class="px-4 py-2">{{ $order->user->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">${{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-4 py-2">
                                        @if($order->status === 'pending')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Pending</span>
                                        @elseif($order->status === 'processing')
                                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Processing</span>
                                        @elseif($order->status === 'delivered')
                                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Delivered</span>
                                        @elseif($order->status === 'cancelled')
                                            <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded">Cancelled</span>
                                        @else
                                            <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:underline">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>