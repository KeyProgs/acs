<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regime extends Model {
   protected $fillable = [
      'id', 'valeur', 'libelle'
   ];
   protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at'
   ];

   public function personnes() {
      return $this->hasMany('App\Personne', 'regime_id', 'id');
   }

   public function regimes_regles() {
      return $this->hasMany('App\Regime_regles', 'regime_id', 'id');
   }
}
