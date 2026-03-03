@extends('layouts.app')

@section('title', 'Manage Flowers')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    <div class="flex justify-between items-center mb-5">
        <h1 class="text-lg font-bold text-gray-800">Manage Flowers</h1>
        <a href="{{ route('admin.flowers.create') }}" class="bg-red-600 text-white text-sm px-4 py-2 rounded hover:bg-red-700">+ Add Flower</a>
    </div>

    <div class="border border-gray-200 rounded overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-4 py-2 text-left font-medium">Image</th>
                    <th class="px-4 py-2 text-left font-medium">Name</th>
                    <th class="px-4 py-2 text-left font-medium">Category</th>
                    <th class="px-4 py-2 text-right font-medium">Price</th>
                    <th class="px-4 py-2 text-center font-medium">Stock</th>
                    <th class="px-4 py-2 text-center font-medium">Status</th>
                    <th class="px-4 py-2 text-right font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flowers as $flower)
                    <tr class="border-b border-gray-100">
                        <td class="px-4 py-2">
                            <img src="{{ $flower->image ? asset('storage/' . $flower->image) : 'https://via.placeholder.com/50' }}" alt="{{ $flower->name }}" class="w-10 h-10 object-cover rounded">
                        </td>
                        <td class="px-4 py-2 font-medium">{{ $flower->name }}</td>
                        <td class="px-4 py-2 text-gray-500">{{ $flower->category->name }}</td>
                        <td class="px-4 py-2 text-right">₱{{ number_format($flower->price, 2) }}</td>
                        <td class="px-4 py-2 text-center">{{ $flower->stock }}</td>
                        <td class="px-4 py-2 text-center">
                            <span class="px-2 py-0.5 rounded text-xs font-medium {{ $flower->available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $flower->available ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-right">
                            <a href="{{ route('admin.flowers.edit', $flower) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                            <form action="{{ route('admin.flowers.destroy', $flower) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Are you sure you want to delete this flower?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-xs">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $flowers->links() }}
    </div>
</div>
@endsection