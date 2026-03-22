<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('customer', function (Order $order) {
                return $order->user->name ?? 'N/A';
            })
            ->editColumn('total', function (Order $order) {
                return '₱' . number_format((float) $order->total, 2);
            })
            ->editColumn('status', function (Order $order) {
                $colors = [
                    'pending'    => 'bg-yellow-100 text-yellow-800',
                    'processing' => 'bg-blue-100 text-blue-800',
                    'delivered'  => 'bg-green-100 text-green-800',
                    'cancelled'  => 'bg-red-100 text-red-800',
                ];
                $class = $colors[$order->status] ?? 'bg-gray-100 text-gray-800';
                return '<span class="' . $class . ' text-xs px-2 py-1 rounded-full font-medium">'
                    . ucfirst($order->status) . '</span>';
            })
            ->editColumn('created_at', fn (Order $row) => $row->created_at->format('M d, Y'))
            ->addColumn('action', function (Order $order) {
                return '<a href="' . route('admin.orders.show', $order) . '"
                    class="text-red-600 hover:underline text-sm font-medium">View</a>';
            })
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery()->with('user')->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('orders-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('print'),
                Button::make('reload'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width(50),
            Column::make('order_number')->title('Order #'),
            Column::computed('customer')->title('Customer'),
            Column::make('total')->title('Total')->width(100),
            Column::make('status')->title('Status')->width(100),
            Column::make('created_at')->title('Date')->width(120),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Action'),
        ];
    }

    protected function filename(): string
    {
        return 'Orders_' . date('YmdHis');
    }
}
