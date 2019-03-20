<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Fiche extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'provenance_id', 'user_id', 'equipes_autorisees',
      'etat_id', 'sous_etat_id', 'personne_id','date_effet', 'date_rappel', 'note', 'recommend'
   ];

   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];

   public function provenance() {
      return $this->hasOne('App\Provenance', 'id', 'provenance_id');
   }


   public function user() {
      return $this->belongsTo('App\User', 'user_id');
   }

   public function personne() {
      return $this->hasOne('App\Personne', 'id', 'personne_id');
   }

   public function etat() {
      return $this->hasOne('App\Fiche_etat', 'id', 'etat_id');
   }

   public function historique() {
      return $this->hasMany('App\Historique', 'fiche_id', 'id');
   }

   public function simulation() {
      return $this->hasOne('App\Simulation', 'fiche_id', 'id')->latest('id');
   }

   public function simulations() {
      return $this->hasMany('App\Simulation', 'fiche_id', 'id');
   }

   public function compte() {
      return $this->hasOne('App\Compte', 'fiche_id', 'id');
      /*$simulations = Simulation::where('fiche_id', '=', $this->id)->orderBy('id', 'DESC')->get();
      foreach($simulations as $simulation) {
         $devis = Devis::where('simulation_id', '=', $simulation->id)->orderBy('id', 'DESC')->get();
         foreach($devis as $devi) {
            $compte = Compte::where('id', '=', $devi->compte_id)->orderBy('id', 'DESC')->first();
            return $compte;
         }
      }*/
   }

   public function isInGamme($IdGamme, $message = null) {
      $Personnes = $this->getPersonnes();
      $valide = true;
      foreach($Personnes as $personne) {
         //echo "<h1>IdGamme $IdGamme ****</h1>   <br>";
         $gamme = Gamme::findOrFail($IdGamme);
         if($gamme->TchequeAge($personne->age()) == false) {
            $valide = false;
            $message = "Cette fiche n'est pas elligible !";
            return $message;
         }
      }
      return ($valide);
   }

   public function getPersonnes() {
      return Personne::whereIn('id', Personne_personne::where('personne_id', '=', $this->personne->id)->get()->pluck('personne_concerne_id'))->get();
   }

   public function changerUserTo($user_id, $description = null) {
      $this->user_id = $user_id;
      $historique = new Historique();
      $historique->create(['fiche_id' => $this->id, 'user_id' => Auth::user()->id, 'description' => $description, 'action_id' => 4, 'vue' => FALSE]);
   }

   public function changerEtatTo($etat_id, $description = null) {
      $this->etat_id = $etat_id;
      $historique = new Historique();
      $historique->create(['fiche_id' => $this->id, 'user_id' => Auth::user()->id, 'description' => $description, 'action_id' => 4, 'vue' => FALSE]);

   }

   public function ville() {
      // return $this->hasMany('App\Historique', 'fiche_id', 'id');
      return $this->hasOne('App\villes', 'id', 'ville_id');
   }


   public function resiliations() {
      return $this->hasMany('App\Resiliation', 'fiche_id', 'id');
   }

   public function piece_jointes() {
      return $this->hasMany('App\Piece_jointe', 'fiche_id', 'id');
   }


}
