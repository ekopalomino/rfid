<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMovement extends Model
{
    protected $fillable = [
        'product_id',
        'origin_location',
        'origin_branch',
        'origin_department',
        'destination_location',
        'destination_branch',
        'destination_dept',
    ];

    public function Parent()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function Locations()
    {
        return $this->belongsTo(Location::class,'origin_location');
    }

    public function Branches()
    {
        return $this->belongsTo(Warehouse::class,'origin_branch');
    }

    public function Departments()
    {
        return $this->belongsTo(Division::class,'origin_department');
    }

    public function DestLocations()
    {
        return $this->belongsTo(Location::class,'destination_location');
    }

    public function DestBranch()
    {
        return $this->belongsTo(Warehouse::class,'destination_branch');
    }

    public function DestDept()
    {
        return $this->belongsTo(Division::class,'destination_dept');
    }
}
