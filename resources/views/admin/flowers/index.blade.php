@extends('layouts.app')
@section('title', 'Manage Flowers')
@section('content')
<div class="fd-container py-4 md:py-6">
    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="fd-link text-sm font-semibold">&larr; Back to Admin</a>
    </div>
    <div class="fd-panel p-4 mb-4">
        <form action="{{ route('admin.flowers.index') }}" method="GET" class="flex flex-wrap gap-2 items-center">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by flower, slug, or category..."
                class="fd-input flex-1 min-w-[240px]"
            >
            <button type="submit" class="fd-btn-primary text-sm">Search</button>
            @if(request('search'))
                <a href="{{ route('admin.flowers.index') }}" class="text-sm text-slate-500 hover:underline">Clear</a>
            @endif
        </form>
    </div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold" style="font-family: 'Playfair Display', serif;">Manage Flowers</h1>
        <div class="flex gap-2">
            <form action="{{ route('admin.flowers.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                @csrf
                <input type="file" name="file" accept=".xlsx,.xls,.csv" class="fd-input py-1.5 text-sm" required>
                <button type="submit" class="inline-flex items-center justify-center rounded-xl px-4 py-2 text-sm font-semibold text-white bg-green-600 hover:bg-green-700">Import Excel</button>
            </form>
            <a href="{{ route('admin.flowers.create') }}" class="fd-btn-primary text-sm">+ Add Flower</a>
        </div>
    </div>
    <div class="fd-panel overflow-hidden">
        <table class="fd-table min-w-full">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($flowers as $flower)
                <tr class="hover:bg-gray-50 {{ $flower->trashed() ? 'bg-red-50 opacity-60' : '' }}">
                    <td>
                        @if($flower->image)
                            <img src="{{ asset('storage/' . $flower->image) }}" class="w-12 h-12 object-cover rounded-xl border border-orange-100">
                        @else
                            <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center text-xs text-orange-300">No img</div>
                        @endif
                    </td>
                    <td class="font-medium text-slate-800">{{ $flower->name }}</td>
                    <td class="text-sm text-slate-600">{{ $flower->category->name ?? 'N/A' }}</td>
                    <td class="text-sm text-orange-700 font-semibold">₱{{ number_format($flower->price, 2) }}</td>
                    <td class="text-sm">{{ $flower->stock }}</td>
                    <td>
                        @if($flower->trashed())
                            <span class="fd-status-danger">Deleted</span>
                        @elseif($flower->available)
                            <span class="fd-status-ok">Available</span>
                        @else
                            <span class="fd-status-warn">Unavailable</span>
                        @endif
                    </td>
                    <td class="text-sm">
                        @if($flower->trashed())
                            <form action="{{ route('admin.flowers.restore', $flower->id) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <button class="text-green-600 hover:underline text-sm">Restore</button>
                            </form>
                        @else
                            <a href="{{ route('admin.flowers.edit', $flower) }}" class="fd-link hover:underline mr-2">Edit</a>
                            <form action="{{ route('admin.flowers.destroy', $flower) }}" method="POST" class="inline" onsubmit="return confirm('Delete this flower?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:underline">Delete</button>
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