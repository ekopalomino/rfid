<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'warehouse_id',
        'location_name',
        'location_detail'
    ];

    public function Warehouses()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id');
    }
}
