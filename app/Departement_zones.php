<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departement_zones extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'zone_id',
        'departement_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
