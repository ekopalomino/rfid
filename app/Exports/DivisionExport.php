<?php

namespace iteos\Exports;

use iteos\Models\Division;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DivisionExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'id',
            'Department Name',
            'Prefix'
        ];
    }

    public function collection()
    {
        return Division::where('deleted_at',NULL)->select('id','name','prefix')->get();
    }
}
