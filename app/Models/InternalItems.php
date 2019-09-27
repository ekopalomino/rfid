<?php

namespace Erp\Models;

use Illuminate\Database\Eloquent\Model;

class InternalItems extends Model
{
    protected $fillable = [
        'product_id',
        'mutasi_id',
        'quantity',
        'uom_id',
    ];

    public function Products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function Uoms()
    {
        return $this->belongsTo(UomValue::class,'uom_id');
    }
}
