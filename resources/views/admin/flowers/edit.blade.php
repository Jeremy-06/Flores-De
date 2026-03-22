@extends('layouts.app')
@section('title', 'Edit Flower')
@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6">Edit: {{ $flower->name }}</h1>
    <form action="{{ route('admin.flowers.update', $flower) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
            <input type="text" name="name" value="{{ old('name', $flower->name) }}" class="w-full border rounded px-3 py-2" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $flower->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
            <textarea name="description" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('description', $flower->description) }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                <input type="number" name="price" value="{{ old('price', $flower->price) }}" step="0.01" min="0" class="w-full border rounded px-3 py-2" required>
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stock *</label>
                <input type="number" name="stock" value="{{ old('stock', $flower->stock) }}" min="0" class="w-full border rounded px-3 py-2" required>
                @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        @if($flower->image)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Current Main Image</label>
            <img src="{{ asset('storage/' . $flower->image) }}" class="w-32 h-32 object-cover rounded">
        </div>
        @endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Replace Main Image</label>
            <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
        </div>
        @if($flower->images->count())
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Gallery Images</label>
            <div class="flex flex-wrap gap-3">
                @foreach($flower->images as $img)
                <div class="relative group">
                    <img src="{{ asset('storage/' . $img->image_path) }}" class="w-24 h-24 object-cover rounded">
                    <form action="{{ route('admin.flowers.destroyImage', $img) }}" method="POST" class="absolute top-0 right-0">
                        @csrf @method('DELETE')
                        <button class="bg-red-600 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center opacity-0 group-hover:opacity-100 transition">&times;</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Add More Images</label>
            <input type="file" name="images[]" multiple accept="image/*" class="w-full border rounded px-3 py-2">
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="available" value="1" {{ old('available', $flower->available) ? 'checked' : '' }} class="rounded">
            <label class="text-sm text-gray-700">Available for purchase</label>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">Update Flower</button>
            <a href="{{ route('admin.flowers.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">Cancel</a>
        </div>
    </form>
</div>
@endsection