@extends('layouts.app')

@section('title', 'Manage Flowers')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-gray-800">Manage Flowers</h1>
            <p class="text-gray-400 mt-1 text-sm">{{ $flowers->total() }} flowers in your catalog</p>
        </div>
        <a href="{{ route('admin.flowers.create') }}" class="btn-primary flex items-center gap-2 !px-5 !py-2.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Add Flower
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-rose-100/50 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gradient-to-r from-rose-50 to-pink-50">
                    <th class="px-6 py-3.5 text-left font-semibold text-gray-600 text-xs uppercase tracking-wider">Flower</th>
                    <th class="px-6 py-3.5 text-left font-semibold text-gray-600 text-xs uppercase tracking-wider hidden md:table-cell">Category</th>
                    <th class="px-6 py-3.5 text-right font-semibold text-gray-600 text-xs uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3.5 text-center font-semibold text-gray-600 text-xs uppercase tracking-wider hidden sm:table-cell">Stock</th>
                    <th class="px-6 py-3.5 text-center font-semibold text-gray-600 text-xs uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3.5 text-right font-semibold text-gray-600 text-xs uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-rose-50">
                @foreach($flowers as $flower)
                    <tr class="hover:bg-rose-50/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $flower->image ? asset('storage/' . $flower->image) : 'https://via.placeholder.com/50' }}" alt="{{ $flower->name }}" class="w-12 h-12 object-cover rounded-xl border border-rose-100 shadow-sm">
                                <span class="font-semibold text-gray-800">{{ $flower->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-rose-50 text-rose-600">{{ $flower->category->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-right font-bold text-gray-700">₱{{ number_format($flower->price, 2) }}</td>
                        <td class="px-6 py-4 text-center hidden sm:table-cell">
                            <span class="inline-flex items-center justify-center min-w-[2rem] px-2 py-0.5 rounded-full text-xs font-bold {{ $flower->stock > 10 ? 'bg-emerald-50 text-emerald-600' : ($flower->stock > 0 ? 'bg-amber-50 text-amber-600' : 'bg-red-50 text-red-600') }}">
                                {{ $flower->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-bold ring-1 {{ $flower->available ? 'bg-emerald-50 text-emerald-600 ring-emerald-200' : 'bg-red-50 text-red-600 ring-red-200' }}">
                                {{ $flower->available ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.flowers.edit', $flower) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 text-xs font-semibold transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.flowers.destroy', $flower) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this flower?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 text-xs font-semibold transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $flowers->links() }}
    </div>
</div>
@endsection