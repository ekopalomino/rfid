<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use Uuid;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'deleted_at'
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
}
