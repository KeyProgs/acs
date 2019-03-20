<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model {
   protected $fillable = [
      'id', 'valeur','libelle'
   ];
   protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at'
   ];
}
