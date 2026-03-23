@extends('layouts.app')
@section('title', 'Add Category')

@section('content')
<div class="max-w-xl mx-auto px-4 py-6">
    <div class="mb-6">
        <a href="{{ route('admin.categories.index') }}" class="text-pink-600 hover:underline text-sm">&larr; Back to Categories</a>
    </div>
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="bg-white border border-gray-200 rounded-lg p-6 space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name *</label>
            <input id="name" name="name" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-pink-500 focus:ring-pink-500" value="{{ old('name') }}" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-2 pt-2">
            <button type="submit" class="bg-pink-600 text-white px-6 py-2 rounded hover:bg-pink-700 text-sm font-semibold">Create Category</button>
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-100 text-gray-700 px-6 py-2 rounded hover:bg-gray-200 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection