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
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Order> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Order $order) {
                return '<a href="' . route('admin.orders.show', $order) . '"
                    class="text-blue-600 hover:underline text-xs font-medium">View</a>';
            })
            ->addColumn('customer', function (Order $order) {
                return $order->user->name ?? $order->customer_name ?? 'N/A';
            })
            ->editColumn('total', function (Order $order) {
                return '₱' . number_format($order->total, 2);
            })
            ->editColumn('status', function (Order $order) {
                $colors = [
                    'pending'    => 'bg-yellow-100 text-yellow-800',
                    'processing' => 'bg-blue-100 text-blue-800',
                    'delivered'  => 'bg-green-100 text-green-800',
                    'cancelled'  => 'bg-red-100 text-red-800',
                ];
                $class = $colors[$order->status] ?? 'bg-gray-100 text-gray-800';
                return '<span class="' . $class . ' text-xs px-2 py-1 rounded">'
                    . ucfirst($order->status) . '</span>';
            })
            ->editColumn('created_at', fn (Order $row) => $row->created_at->format('M d, Y'))
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Order>
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('orders-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('id')->title('#'),
            Column::make('order_number')->title('Order #'),
            Column::computed('customer')->title('Customer'),
            Column::make('total')->title('Total'),
            Column::make('status')->title('Status'),
            Column::make('created_at')->title('Date'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Orders_' . date('YmdHis');
    }
}
