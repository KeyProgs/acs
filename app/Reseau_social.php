<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reseau_social extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'nom'
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];
}
