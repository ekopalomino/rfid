<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'asset_id',
        'sap_code',
        'name',
        'category_id',
        'branch_id',
        'location_id',
        'department_id',
        'parent_id',
        'image',
        'price',
        'specification',
        'purchase_date',
        'deleted_at',
        'created_by',
        'updated_by',
    ];

    public function Author()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function Editor()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    public function Categories()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }

    public function Branches()
    {
        return $this->belongsTo(Warehouse::class,'branch_id');
    }

    public function Locations()
    {
        return $this->belongsTo(Location::class,'sap_id','location_id');
    }

    public function Divisions()
    {
        return $this->belongsTo(Division::class,'department_id');
    }

    public function Child()
    {
        return $this->hasMany(ProductMovement::class);
    }
}
