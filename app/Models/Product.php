<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Uuid;

    protected $fillable = [
        'rfid_code',
        'sap_code',
        'name',
        'category_id',
        'branch_id',
        'location_id',
        'department_id',
        'image',
        'price',
        'specification',
        'purchase_date',
        'warranty_period',
        'active',
        'deleted_at',
        'created_by',
        'updated_by',
    ];

    public $incrementing = false;

    public function Author()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function Editor()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    public function Statuses()
    {
        return $this->belongsTo(Status::class,'active');
    }

    public function Categories()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }

    public function Invent()
    {
        return $this->hasMany(Inventory::class,'product_id');
    }

    public function Details()
    {
        return $this->hasMany(ProductBom::class,'product_id');
    }

    public function Manufactures()
    {
        return $this->hasOne(ManufactureItem::class,'item_id');
    }
}
