<?php

use Illuminate\Database\Seeder;
use iteos\Models\Warranty;

class WarrantyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'No Warranty',
            '1 Month',
            '3 Month',
            '6 Month',
            '12 Month',
            '24 Month'
        ];

        foreach($statuses as $status) {
            Warranty::create(['warranty_name' => $status]);
        }
    }
}
