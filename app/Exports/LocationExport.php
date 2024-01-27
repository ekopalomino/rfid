<?php

namespace iteos\Exports;

use iteos\Models\Location;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LocationExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'id',
            'Location Name',
        ];
    }

    public function collection()
    {
        return Location::where('deleted_at',NULL)->select('id','location_name')->get();
    }
}
