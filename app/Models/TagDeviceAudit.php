<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class TagDeviceAudit extends Model
{
    protected $fillable = [
        'product_id',
        'audit_branch',
        'audit_location'
    ];

    public function Products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
