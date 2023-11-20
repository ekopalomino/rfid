<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMovement extends Model
{
    protected $fillable = [
        'product_id',
        'origin_location',
        'origin_branch',
        'destination_location',
        'destination_branch'
    ];
}
