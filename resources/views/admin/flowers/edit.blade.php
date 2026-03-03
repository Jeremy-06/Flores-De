@extends('layouts.app')

@section('title', 'Edit Flower')

@section('content')
<div class="max-w-xl mx-auto px-4">
    <h1 class="text-lg font-bold mb-5 text-gray-800">Edit Flower</h1>

    <form action="{{ route('admin.flowers.update', $flower) }}" method="POST" enctype="multipart/form-data" class="border border-gray-200 rounded p-5">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-medium mb-1">Flower Name</label>
            <input type="text" name="name" value="{{ old('name', $flower->name) }}" required class="w-full border-gray-300 rounded text-sm">
            @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-medium mb-1">Category</label>
            <select name="category_id" required class="w-full border-gray-300 rounded text-sm">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $flower->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="4" required class="w-full border-gray-300 rounded text-sm">{{ old('description', $flower->description) }}</textarea>
            @error('description') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1">Price (₱)</label>
                <input type="number" name="price" value="{{ old('price', $flower->price) }}" step="0.01" min="0" required class="w-full border-gray-300 rounded text-sm">
                @error('price') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $flower->stock) }}" min="0" required class="w-full border-gray-300 rounded text-sm">
                @error('stock') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-medium mb-1">Image</label>
            @if($flower->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $flower->image) }}" alt="{{ $flower->name }}" class="w-24 h-24 object-cover rounded mb-2">
                    <p class="text-xs text-gray-500">Current image</p>
                </div>
            @endif
            <input type="file" name="image" accept="image/*" class="w-full text-sm">
            @error('image') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="available" value="1" {{ old('available', $flower->available) ? 'checked' : '' }} class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                <span class="text-sm text-gray-700">Available for sale</span>
            </label>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-red-600 text-white text-sm px-5 py-2 rounded hover:bg-red-700">Update Flower</button>
            <a href="{{ route('admin.flowers.index') }}" class="border border-gray-300 text-gray-600 text-sm px-5 py-2 rounded hover:bg-gray-50">Cancel</a>
        </div>
    </form>
</div>
@endsection