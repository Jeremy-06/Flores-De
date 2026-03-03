<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order #' . $order->id) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('admin.orders.index') }}" class="text-red-600 hover:underline mb-4 inline-block">&larr; Back to Orders</a>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Order Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Order Details</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>Customer:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                            <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                            <p><strong>Phone:</strong> {{ $order->phone ?? 'N/A' }}</p>
                            <p><strong>Address:</strong> {{ $order->delivery_address ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                            <p><strong>Delivery Date:</strong> {{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('M d, Y') : 'N/A' }}</p>
                            <p><strong>Status:</strong>
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
                            </p>
                            <p><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                        </div>
                    </div>

                    @if($order->message)
                        <div class="mt-4">
                            <p><strong>Message:</strong></p>
                            <p class="bg-gray-50 p-3 rounded mt-1">{{ $order->message }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Order Items</h3>

                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-pink-50">
                                <th class="px-4 py-2 text-left">Flower</th>
                                <th class="px-4 py-2 text-left">Price</th>
                                <th class="px-4 py-2 text-left">Quantity</th>
                                <th class="px-4 py-2 text-left">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $item->flower_name }}</td>
                                    <td class="px-4 py-2">${{ number_format($item->price, 2) }}</td>
                                    <td class="px-4 py-2">{{ $item->quantity }}</td>
                                    <td class="px-4 py-2">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="font-semibold">
                                <td colspan="3" class="px-4 py-2 text-right">Total:</td>
                                <td class="px-4 py-2">${{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Update Status -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Update Status</h3>

                    <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="flex items-center gap-4">
                        @csrf
                        @method('PUT')

                        <select name="status" class="border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>

                        <x-primary-button>
                            {{ __('Update Status') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>