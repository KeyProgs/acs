<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Base extends Model {
   protected $fillable = [
      'parametre_nom', 'parametre_nom'
   ];

   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];
}
