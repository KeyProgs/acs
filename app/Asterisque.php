<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asterisque extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'valeur', 'description', 'valeur_id', 'sous_volet_id'
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];
}
