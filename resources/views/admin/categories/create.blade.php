<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('admin.categories.index') }}" class="text-red-600 hover:underline mb-4 inline-block">&larr; Back to Categories</a>

                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Category Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <x-primary-button>
                            {{ __('Create Category') }}
                        </x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>