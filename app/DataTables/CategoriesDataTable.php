<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Category> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Category $category) {
                $edit = '<a href="' . route('admin.categories.edit', $category) . '"
                    class="text-blue-600 hover:underline text-xs font-medium">Edit</a>';

                $delete = '<form action="' . route('admin.categories.destroy', $category) . '"
                    method="POST" class="inline ml-2"
                    onsubmit="return confirm(\'Are you sure you want to delete this category?\')">'
                    . csrf_field()
                    . method_field('DELETE')
                    . '<button type="submit" class="text-red-600 hover:underline text-xs font-medium">Delete</button>'
                    . '</form>';

                return $edit . $delete;
            })
            ->addColumn('flowers_count', fn (Category $row) => $row->flowers_count)
            ->editColumn('created_at', fn (Category $row) => $row->created_at->format('M d, Y'))
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Category>
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery()->withCount('flowers');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('categories-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'processing' => false,
                'language' => [
                    'processing' => '',
                ],
            ])
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
                ->width(80)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('name'),
            Column::make('slug'),
            Column::computed('flowers_count')->title('Flowers'),
            Column::make('created_at')->title('Created'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Categories_' . date('YmdHis');
    }
}
