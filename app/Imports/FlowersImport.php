<?php
namespace App\Imports;
use App\Models\Flower;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class FlowersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Flower([
            'category_id'  => $row['category_id'],
            'name'         => $row['name'],
            'slug'         => Str::slug($row['name']),
            'description'  => $row['description'] ?? '',
            'price'        => $row['price'],
            'stock'        => $row['stock'] ?? 0,
            'available'    => $row['available'] ?? true,
        ]);
    }
}