<?php

namespace iteos\Imports;

use iteos\Models\Product;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $data = Product::firstOrCreate([
            'sap_code' => $row['sap_code'],
            'name' => $row['name'],
            'category_id' => $row['category_id'],
            'branch_id' => $row['branch_id'],
            'location_id' => $row['location_id'],
            'created_by' => Auth()->user()->id,
        ]);
    }

    public function chunkSize(): int
    {
        return 50;
    }

    public function batchSize(): int
    {
        return 50;
    }

}
