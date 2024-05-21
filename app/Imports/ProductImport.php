<?php

namespace iteos\Imports;

use iteos\Models\Product;
use iteos\Models\ProductMovement;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithLimit;

class ProductImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts, WithLimit
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $rows = 0;

    public function model(array $row)
    {
        ++$this->rows;
        $data = Product::firstOrCreate([
            'asset_id' => bin2hex($row['sap_code']),
            'sap_code' => $row['sap_code'],
            'name' => $row['name'],
            'category_id' => $row['category_id'],
            'parent_id' => $row['parent_code'],
            'branch_id' => $row['branch_id'],
            'location_id' => $row['location_id'],
            'department_id' => $row['department_id'],
            'created_by' => Auth()->user()->id,
        ]);

        $movement = ProductMovement::create([
            'product_id' => $data->id,
            'origin_branch' => $data->branch_id,
            'origin_location' => $data->location_id,
            'origin_department' => $data->department_id,
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function limit(): int
    {
        return 1000; 
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }

}
