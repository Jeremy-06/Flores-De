@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
<div class="fd-container max-w-3xl py-4 md:py-8">
    <h1 class="text-3xl font-bold mb-6" style="font-family: 'Playfair Display', serif;">My Profile</h1>

    <div class="space-y-6">
        <div class="fd-panel p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="fd-panel p-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="fd-panel p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
