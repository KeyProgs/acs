<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hconnexion extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'email',
        'adresse_ip',
    ];

    protected $dates =[
        'deleted_at',
        'updated_at',
        'deleted_at'
    ];
}
