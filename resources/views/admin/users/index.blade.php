@extends('layouts.app')
@section('title', 'Manage Users')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="text-pink-600 hover:underline text-sm font-semibold">&larr; Back to Admin</a>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 p-4 mb-4">
        <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-wrap gap-2 items-center">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by name, email, role, or status..."
                class="border border-gray-300 rounded px-3 py-2 text-sm flex-1 min-w-[240px]"
            >
            <button type="submit" class="bg-pink-600 text-white text-sm px-4 py-2 rounded hover:bg-pink-700">Search</button>
            @if(request('search'))
                <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:underline">Clear</a>
            @endif
        </form>
    </div>
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage Users</h1>
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full">
            <thead>
                <tr class="bg-pink-50 border-b border-gray-200">
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Photo</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center text-xs font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $user->name }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $user->email }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded-full font-medium {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded-full font-medium {{ $user->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($user->status) }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-pink-600 hover:underline text-sm">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $users->links() }}</div>
</div>
@endsection