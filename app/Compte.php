<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model {
   protected $fillable = [
      'id', 'personne_id', 'numero_carte', 'iban', 'bic', 'adresse', 'ville_id', 'banque_id',
      'fiche_id', 'nom', 'prenom', 'adresse_tt', 'ville_id_tt', 'code_postal_tt'
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];

   public function personne() {
      return $this->hasOne('App\Personne', 'id', 'personne_id');
   }

   public function banque() {
      return $this->hasOne('App\Banque', 'id', 'banque_id');
   }

   public function ville() {
      return $this->hasOne('App\Ville', 'id', 'ville_id');
   }

   public function ville_tt() {
      return $this->hasOne('App\Ville', 'id', 'ville_id_tt');
   }

   public function devis() {
      return $this->belongsTo('App\Devis', 'id', 'compte_id');
   }
}
