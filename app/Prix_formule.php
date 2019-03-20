<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prix_formule extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'regle_id', 'age', 'prix'
   ];
   protected $dates = [
      'deleted_at', 'updated_at', 'deleted_at'
   ];
}
