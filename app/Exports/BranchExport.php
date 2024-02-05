<?php

namespace iteos\Exports;

use iteos\Models\Warehouse;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BranchExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'id',
            'Branch Name',
        ];
    }

    public function collection()
    {
        return Warehouse::where('deleted_at',NULL)->select('id','name')->get();
    }
}
