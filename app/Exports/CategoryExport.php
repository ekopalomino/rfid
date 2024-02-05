<?php

namespace iteos\Exports;

use iteos\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CategoryExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'id',
            'Category Name',
        ];
    }

    public function collection()
    {
        return ProductCategory::where('deleted_at',NULL)->select('id','name')->get();
    }
}
