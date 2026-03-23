@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<div class="max-w-xl mx-auto px-4 py-6">
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-pink-600 hover:underline text-sm">&larr; Back to Users</a>
    </div>
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit User: {{ $user->name }}</h1>
    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <p class="text-gray-800 bg-gray-50 rounded px-3 py-2 text-sm">{{ $user->name }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <p class="text-gray-800 bg-gray-50 rounded px-3 py-2 text-sm">{{ $user->email }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="role" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-pink-500 focus:ring-pink-500">
                <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-pink-500 focus:ring-pink-500">
                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="flex gap-2 pt-2">
            <button type="submit" class="bg-pink-600 text-white px-6 py-2 rounded hover:bg-pink-700 text-sm font-semibold">Update</button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-100 text-gray-700 px-6 py-2 rounded hover:bg-gray-200 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection