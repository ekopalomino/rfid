<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'sap_id',
        'warehouse_id',
        'location_name',
        'location_detail',
        'created_by',
        'updated_by',
        'deleted_at'
    ];

    public function Warehouses()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id');
    }

    public function Author()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function Editor()
    {
        return $this->belongsTo(User::class,'updated_by');
    }
}
