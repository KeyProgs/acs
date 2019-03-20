<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'gamme_id',
        'zone',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
