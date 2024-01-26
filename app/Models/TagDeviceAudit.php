<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class TagDeviceAudit extends Model
{
    protected $fillable = [
        'product_id',
        'branch_id',
        'location_id'
    ];

    public function Branches()
    {
        return $this->belongsTo(Warehouse::class,'branch_id');
    }

    public function Products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function Locations()
    {
        return $this->belongsTo(Location::class,'location_id');
    }
}
