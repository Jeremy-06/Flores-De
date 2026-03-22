@extends('layouts.app')
@section('title', 'Manage Reviews')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6">All Reviews</h1>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded text-sm mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden p-4">
        {{ $dataTable->table(['class' => 'min-w-full divide-y divide-gray-200', 'style' => 'width:100%']) }}
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<style>
    table.dataTable { border-collapse: collapse !important; }
    table.dataTable thead th { background: #f9fafb; font-size: 12px; text-transform: uppercase; color: #6b7280; padding: 12px 10px; }
    table.dataTable tbody td { font-size: 14px; padding: 12px 10px; }
    .dataTables_wrapper .dataTables_filter input { border: 1px solid #d1d5db; border-radius: 6px; padding: 6px 12px; }
    .dataTables_wrapper .dataTables_length select { border: 1px solid #d1d5db; border-radius: 6px; padding: 4px 8px; }
    .dt-buttons .dt-button { background: #f3f4f6 !important; border: 1px solid #d1d5db !important; border-radius: 6px !important; padding: 4px 12px !important; font-size: 13px !important; }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
{{ $dataTable->scripts() }}
@endpush
