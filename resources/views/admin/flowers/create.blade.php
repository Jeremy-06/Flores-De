@extends('layouts.app')
@section('title', 'Add Flower')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <div class="mb-6">
        <a href="{{ route('admin.flowers.index') }}" class="text-pink-600 hover:underline text-sm">&larr; Back to Flowers</a>
    </div>
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Flower</h1>
    <form action="{{ route('admin.flowers.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-pink-500 focus:ring-pink-500" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
            <select name="category_id" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-pink-500 focus:ring-pink-500" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-pink-500 focus:ring-pink-500" required>{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-pink-500 focus:ring-pink-500" required>
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stock *</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-pink-500 focus:ring-pink-500" required>
                @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Main Image</label>
            <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-pink-500 focus:ring-pink-500">
            @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Additional Images (multiple)</label>
            <input type="file" name="images[]" multiple accept="image/*" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-pink-500 focus:ring-pink-500">
            @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="available" value="1" {{ old('available', true) ? 'checked' : '' }} class="rounded text-pink-600 focus:ring-pink-500">
            <label class="text-sm text-gray-700">Available for purchase</label>
        </div>
        <div class="flex gap-2 pt-2">
            <button type="submit" class="bg-pink-600 text-white px-6 py-2 rounded hover:bg-pink-700 text-sm font-semibold">Save Flower</button>
            <a href="{{ route('admin.flowers.index') }}" class="bg-gray-100 text-gray-700 px-6 py-2 rounded hover:bg-gray-200 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection