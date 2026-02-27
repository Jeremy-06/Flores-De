@extends('layouts.app')

@section('title', 'Edit Flower')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back & Title -->
    <div class="mb-8">
        <a href="{{ route('admin.flowers.index') }}" class="inline-flex items-center gap-1 text-gray-400 hover:text-rose-500 text-sm mb-3 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
            Back to Flowers
        </a>
        <h1 class="text-3xl font-display font-bold text-gray-800">Edit Flower</h1>
        <p class="text-gray-400 mt-1 text-sm">Update the details for <strong class="text-gray-600">{{ $flower->name }}</strong></p>
    </div>

    <form action="{{ route('admin.flowers.update', $flower) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-rose-100/50 shadow-sm p-6 sm:p-8">
        @csrf
        @method('PUT')

        <div class="space-y-5">
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-1.5">Flower Name <span class="text-rose-400">*</span></label>
                <input type="text" name="name" value="{{ old('name', $flower->name) }}" required class="input-elegant w-full">
                @error('name') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-1.5">Category <span class="text-rose-400">*</span></label>
                <select name="category_id" required class="input-elegant w-full">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $flower->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-1.5">Description <span class="text-rose-400">*</span></label>
                <textarea name="description" rows="4" required class="input-elegant w-full">{{ old('description', $flower->description) }}</textarea>
                @error('description') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1.5">Price (₱) <span class="text-rose-400">*</span></label>
                    <input type="number" name="price" value="{{ old('price', $flower->price) }}" step="0.01" min="0" required class="input-elegant w-full">
                    @error('price') <p class="text-rose-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1.5">Stock <span class="text-rose-400">*</span></label>
                    <input type="number" name="stock" value="{{ old('stock', $flower->stock) }}" min="0" required class="input-elegant w-full">
                    @error('stock') <p class="text-rose-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-1.5">Image</label>
                @if($flower->image)
                    <div class="mb-3 relative inline-block">
                        <img src="{{ asset('storage/' . $flower->image) }}" alt="{{ $flower->name }}" class="w-28 h-28 object-cover rounded-xl border border-rose-100 shadow-sm">
                        <span class="absolute -top-2 -right-2 bg-emerald-500 text-white text-[10px] px-1.5 py-0.5 rounded-full font-bold">Current</span>
                    </div>
                @endif
                <div class="border-2 border-dashed border-rose-200 rounded-xl p-6 text-center hover:border-rose-400 hover:bg-rose-50/30 transition-all cursor-pointer" onclick="document.getElementById('image-input').click()">
                    <svg class="w-8 h-8 text-rose-300 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.41a2.25 2.25 0 013.182 0l2.909 2.91m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                    <p class="text-sm text-gray-500">Click to upload a new image</p>
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP up to 2MB</p>
                </div>
                <input type="file" name="image" id="image-input" accept="image/*" class="hidden">
                @error('image') <p class="text-rose-500 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 bg-rose-50/50 rounded-xl p-4">
                <input type="checkbox" name="available" id="available" value="1" {{ old('available', $flower->available) ? 'checked' : '' }} class="rounded-md border-rose-300 text-rose-500 focus:ring-rose-500 w-5 h-5">
                <label for="available" class="text-gray-700 text-sm font-medium">Available for sale</label>
            </div>
        </div>

        <div class="mt-8 flex gap-3">
            <button type="submit" class="btn-primary flex-1 !py-3 text-sm">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                Update Flower
            </button>
            <a href="{{ route('admin.flowers.index') }}" class="btn-outline !py-3 px-6 text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection