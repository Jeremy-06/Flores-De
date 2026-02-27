@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-display font-bold text-gray-800">Profile Settings</h1>
        <p class="text-gray-400 mt-1 text-sm">Manage your account information and security.</p>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
