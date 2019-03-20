<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sous_volet extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'volet_id', 'valeur', 'description','gamme_id'
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];

   public function volet() {
      return $this->hasOne('App\Volet', 'id', 'volet_id');
   }

   public function gamme() {
      return $this->hasOne('App\Gamme', 'id', 'gamme_id');
   }

   public function valeurs() {
      return $this->hasMany('App\Valeur', 'sous_volet_id', 'id');
   }

   public function asterisques() {
      return $this->hasMany('App\Asterisque', 'sous_volet_id', 'id');
   }
}
