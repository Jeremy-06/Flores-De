@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h1>

    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <p class="text-gray-600">Welcome back, <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span>! You're logged in.</p>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('shop.index') }}" class="bg-pink-600 text-white px-4 py-2 rounded text-sm hover:bg-pink-700">Browse Flowers</a>
            <a href="{{ route('orders.index') }}" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded text-sm hover:bg-gray-50">My Orders</a>
            <a href="{{ route('profile.edit') }}" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded text-sm hover:bg-gray-50">Edit Profile</a>
        </div>
    </div>
</div>
@endsection
