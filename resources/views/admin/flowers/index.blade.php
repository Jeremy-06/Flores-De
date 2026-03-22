@extends('layouts.app')
@section('title', 'Manage Flowers')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manage Flowers</h1>
        <div class="flex gap-2">
            <form action="{{ route('admin.flowers.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                @csrf
                <input type="file" name="file" accept=".xlsx,.xls,.csv" class="text-sm border rounded px-2 py-1" required>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700">Import Excel</button>
            </form>
            <a href="{{ route('admin.flowers.create') }}" class="bg-red-600 text-white px-4 py-2 rounded text-sm hover:bg-red-700">+ Add Flower</a>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($flowers as $flower)
                <tr class="{{ $flower->trashed() ? 'bg-red-50 opacity-60' : '' }}">
                    <td class="px-4 py-3">
                        @if($flower->image)
                            <img src="{{ asset('storage/' . $flower->image) }}" class="w-12 h-12 object-cover rounded">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-400">No img</div>
                        @endif
                    </td>
                    <td class="px-4 py-3 font-medium">{{ $flower->name }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $flower->category->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-sm">₱{{ number_format($flower->price, 2) }}</td>
                    <td class="px-4 py-3 text-sm">{{ $flower->stock }}</td>
                    <td class="px-4 py-3">
                        @if($flower->trashed())
                            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">Deleted</span>
                        @elseif($flower->available)
                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Available</span>
                        @else
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">Unavailable</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm">
                        @if($flower->trashed())
                            <form action="{{ route('admin.flowers.restore', $flower->id) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <button class="text-green-600 hover:underline">Restore</button>
                            </form>
                        @else
                            <a href="{{ route('admin.flowers.edit', $flower) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                            <form action="{{ route('admin.flowers.destroy', $flower) }}" method="POST" class="inline" onsubmit="return confirm('Delete this flower?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-4 py-6 text-center text-gray-500">No flowers found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $flowers->links() }}</div>
</div>
@endsection