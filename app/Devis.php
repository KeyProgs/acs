<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Devis extends Model {
   protected $fillable = [
      'id','user_id', 'cotisation', 'reduction', 'numero_contrat', 'date_debut', 'date_fin',
      'fiche_id','fiche_etat_id', 'simulation_id', 'mode_id','date_prelevement', 'compte_id', 'formule_id'
   ];

   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];

   public function simulation() {
      return $this->belongsTo('App\Simulation', 'simulation_id', 'id');
   }
   public function simulation__() {
      return Simulation::find($this->simulation_id)->first();
   }


   public function compte() {
      return $this->hasOne('App\Compte', 'id', 'compte_id');
   }

   public function mode() {
      return $this->hasOne('App\Mode_paiement', 'id', 'mode_id');
   }


   public function formule() {
      return $this->hasOne('App\Formule', 'id', 'formule_id');
   }
}
