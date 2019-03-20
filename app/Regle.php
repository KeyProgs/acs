<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regle extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'formule_id', 'annee','zone_id'
   ];
   protected $dates = [
      'deleted_at', 'updated_at', 'deleted_at'
   ];
}
