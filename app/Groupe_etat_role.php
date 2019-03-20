<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groupe_etat_role extends Model {
   use SoftDeletes;
   protected $fillable = [
      'role_id', 'etat_groupe_id'
   ];

   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];

   public function groupe_etat() {
      return $this->hasOne('App\Etat_groupe', 'id', 'etat_groupe_id');
   }
}
