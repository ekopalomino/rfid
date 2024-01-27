<?php

namespace iteos\Exports;

use iteos\Models\Division;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DivisionExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'id',
            'Department Name',
        ];
    }

    public function collection()
    {
        return Division::where('deleted_at',NULL)->select('id','name')->get();
    }
}
