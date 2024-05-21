<?php

namespace iteos\Exports;

use iteos\Models\Location;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LocationExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'sap_id',
            'Location Name',
        ];
    }

    public function collection()
    {
        return Location::where('deleted_at',NULL)->select('sap_id','location_name')->get();
    }
}
