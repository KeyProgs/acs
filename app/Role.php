<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'valeur','libelle'
   ];

   protected $dates = [
      'deleted_at',
      'updated_at',
      'deleted_at'
   ];

   public function etat_groupe() {
      return $this->hasMany('App\Groupe_etat_role', 'role_id', 'id')->orderBy('etat_groupe_id');
   }

}
