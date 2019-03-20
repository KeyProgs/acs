<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Civilite extends Model {
   protected $fillable = [
      'id', 'valeur','libelle'
   ];

   protected $dates = [
      'deleted_at',
      'updated_at',
      'deleted_at'
   ];
}
