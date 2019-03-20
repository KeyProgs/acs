<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resiliation extends Model {
   protected $fillable = [
      'id', 'fiche_id', 'organisme', 'motif', 'date_echeance', 'numero_police', 'adresse', 'ville', 'ville_id', 'telephone'
   ];

   protected $dates = [
      'created_at', 'updated', 'deleted_at'
   ];

   public function resil_ville() {
      return $this->hasOne('App\Ville', 'id', 'ville_id');
   }
}
