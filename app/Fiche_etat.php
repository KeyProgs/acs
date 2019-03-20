<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Fiche_etat extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'etat_groupe_id', 'valeur', 'libelle',
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];


   public function groupe_etat() {
      return $this->belongsTo('App\Etat_groupe', 'etat_groupe_id', 'id');
   }

   public function devis() {
      return $this->hasMany('App\Devis', 'fiche_etat_id', 'id');
   }

   public function fiches() {
      return $this->hasMany('App\Fiche', 'etat_id', 'id');
   }


   public function countold($id) {
      /*$fiches = Fiche::where('user_id', )
         ->where('etat_id', '=', $id)
         ->get();
      return sizeof($fiches);
      $usersIds = $user->getUsersEquipeByUser($user->id);
      $countFiches = Fiche::whereIn('user_id', $usersIds )
         ->where('etat_id', '=', $etat->id)
         ->get();*/
   }

   public function count($id, $rappel = null) {
      //dd(\Carbon\Carbon::now());
      $user = User::findOrFail(Auth::user()->id);
      $usersIds = $user->getUsersEquipeByUser($user->id);
      $fiche_etats = \DB::table('fiches')->where('etat_id', '=', $id)
         ->whereIn('user_id', $usersIds);
      if(!is_null($rappel)) {
         switch($rappel) {
            case -1:
               $fiche_etats->whereDate('date_rappel', '<', \Carbon\Carbon::now());
               break;
            case 0:
               $fiche_etats->whereDate('date_rappel','=', \Carbon\Carbon::now());
               break;
            case 1:
               $fiche_etats->whereDate('date_rappel', '>', \Carbon\Carbon::now());
               break;
         }
      }
      $fiche_etats = $fiche_etats->count();
      return $fiche_etats;
   }
}
