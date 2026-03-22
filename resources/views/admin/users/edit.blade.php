@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6">Edit User: {{ $user->name }}</h1>
    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <p class="text-gray-800">{{ $user->name }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <p class="text-gray-800">{{ $user->email }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="role" class="w-full border rounded px-3 py-2">
                <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">Update</button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">Cancel</a>
        </div>
    </form>
</div>
@endsection