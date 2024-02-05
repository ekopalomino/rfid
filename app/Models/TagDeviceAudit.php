<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class TagDeviceAudit extends Model
{
    protected $fillable = [
        'sap_code',
        'audit_branch',
        'audit_location'
    ];

    public function Products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
