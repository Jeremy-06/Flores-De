@extends('layouts.app')
@section('title', 'Manage Reviews')

@section('content')
<div class="fd-container py-4 md:py-6">
    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="fd-link text-sm font-semibold">&larr; Back to Admin</a>
    </div>
    <h1 class="text-3xl font-bold mb-6" style="font-family: 'Playfair Display', serif;">All Reviews</h1>

    <div class="fd-panel overflow-hidden p-5">
        {{ $dataTable->table(['class' => 'fd-table min-w-full', 'style' => 'width:100%']) }}
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<style>
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 0.75rem;
        color: #64748b;
        font-size: 0.875rem;
    }

    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #e9d9c8;
        border-radius: 12px;
        background: #fffcf8;
        color: #2a2b31;
        padding: 0.4rem 0.7rem;
    }

    table.dataTable {
        border-collapse: collapse !important;
        width: 100% !important;
        margin-top: 0.25rem !important;
    }

    table.dataTable thead th {
        background: #fff1df;
        font-size: 12px;
        text-transform: uppercase;
        color: #6b7280;
        padding: 12px 10px;
        border-bottom: 1px solid #f2dcc2 !important;
    }

    table.dataTable tbody td {
        font-size: 14px;
        color: #334155;
        padding: 12px 10px;
        border-bottom: 1px solid #f5e7d4;
        background: transparent;
    }

    table.dataTable tbody tr:hover td {
        background: #fff8ef;
    }

    .dt-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        margin-bottom: 0.75rem;
    }

    .dt-buttons .dt-button {
        background: #fffaf3 !important;
        border: 1px solid #eadbc9 !important;
        border-radius: 10px !important;
        padding: 0.4rem 0.75rem !important;
        font-size: 12px !important;
        color: #4b5563 !important;
        box-shadow: none !important;
    }

    .dt-buttons .dt-button:hover {
        background: #fff1df !important;
        border-color: #e8c9a2 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
    }

    .dataTables_wrapper .dataTables_processing,
    .dataTables_wrapper .dataTables_processing > div {
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
        pointer-events: none !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #fff1df !important;
        border: 1px solid #e8c9a2 !important;
        color: #a24a21 !important;
    }

    table.dataTable tbody tr.selected td,
    table.dataTable tbody th.selected {
        background-color: #fff4e8 !important;
    }
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
