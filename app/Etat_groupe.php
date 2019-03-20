<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Etat_groupe extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'valeur', 'libelle'
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];

   public function fiche_etats() {
      return $this->hasMany('App\Fiche_etat', 'etat_groupe_id', 'id');
   }

   public function groupe_etat_roles() {
      return $this->hasMany('App\Groupe_etat_role', 'etat_groupe_id', 'id');
   }


   public function count() {
      $user = User::findOrFail(Auth::user()->id);
      $count = 0;
      $fiche_etats = Fiche_etat::where('etat_groupe_id', '=', $this->id)->get()->pluck('id');
      foreach($fiche_etats as $etat){

         $usersIds = $user->getUsersEquipeByUser($user->id);
         $countFiches = Fiche::whereIn('user_id', $usersIds )
            ->where('etat_id', '=', $etat)
            ->get()->pluck('id');
         $count = $count + sizeof($countFiches);
      }
      return $count;
   }
}
