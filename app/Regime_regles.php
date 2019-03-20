<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regime_regles extends Model
{
    protected $fillable = [
        'regime_id', 'regle_id'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
