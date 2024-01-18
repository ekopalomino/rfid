<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class TagDeviceAudit extends Model
{
    protected $fillable = [
        'tag_id',
        'branch_id',
        'location_id'
    ];
}
