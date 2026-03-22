<?php

namespace App\DataTables;

use App\Models\Review;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ReviewsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('user_name', fn($review) => $review->user->name ?? 'N/A')
            ->addColumn('flower_name', fn($review) => $review->flower->name ?? 'N/A')
            ->addColumn('stars', function ($review) {
                $stars = '';
                for ($i = 1; $i <= 5; $i++) {
                    $stars .= $i <= $review->rating
                        ? '<span class="text-yellow-400">★</span>'
                        : '<span class="text-gray-300">★</span>';
                }
                return $stars;
            })
            ->addColumn('date', fn($review) => $review->created_at->format('M d, Y'))
            ->addColumn('action', function ($review) {
                return '<form action="' . route('admin.reviews.destroy', $review) . '" method="POST" onsubmit="return confirm(\'Delete this review?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                        </form>';
            })
            ->rawColumns(['stars', 'action'])
            ->setRowId('id');
    }

    public function query(Review $model): QueryBuilder
    {
        return $model->newQuery()->with(['user', 'flower'])->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('reviews-table')
                    ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
                    ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width(50),
            Column::make('user_name')->title('User')->orderable(false),
            Column::make('flower_name')->title('Product')->orderable(false),
            Column::make('stars')->title('Rating'),
            Column::make('comment')->title('Comment'),
            Column::make('date')->title('Date'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(80)
                  ->addClass('text-center')
                  ->title('Action'),
        ];
    }

    protected function filename(): string
    {
        return 'Reviews_' . date('YmdHis');
    }
}
