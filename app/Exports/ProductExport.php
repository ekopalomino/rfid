<?php

namespace iteos\Exports;

use iteos\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class ProductExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::with('categories','branches','locations','author',)->where('deleted_at',NULL)->select('sap_code','name','category_id','branch_id',
        'location_id','price','specification','purchase_date','updated_at','created_by')->get();
    }

    public function map($product) : array {
        return [
            $product->sap_code,
            $product->name,
            $product->categories->name,
            $product->branches->name,
            $product->locations->location_name,
            $product->price,
            $product->specification,
            Carbon::parse($product->purchase_date)->toFormattedDateString(),
            Carbon::parse($product->updated_at)->toFormattedDateString(),
            $product->author->name,
        ] ;
 
 
    }

    public function headings(): array
    {
        return [
            'SAP Code',
            'Name',
            'Category',
            'Branch',
            'Location',
            'Price',
            'Specification',
            'Purchase Date',
            'Last Update',
            'Created By'
        ];
    }

    
}
