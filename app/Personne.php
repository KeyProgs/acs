<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Personne extends Authenticatable {
   use SoftDeletes;
   protected $guard = 'personne';
   protected $fillable = [
      'id',
      'nom',
      'prenom',
      'civilite_id',
      'date_naissance',
      'regime_id',
      'situation_familiale_id',
      'activite',
      'numero_securite_sociale',
      'numero_affiliation',
      'email_verified_at',
      'email',
      'password',
      'password_updated_at'
   ];


   protected $hidden = ['password', 'remember_token'];

   //public $ayant_droit = null;

   protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at'
   ];

   /*public function setDateNaissanceAttribute($value) {
      $date_parts = explode('/', $value);
      $this->attributes['date_naissance'] = $date_parts[2].'-'.$date_parts[1].'-'.$date_parts[0];
   }
   public function getDateNaissanceAttribute($value) {
      return date('d/m/Y', strtotime($this->attributes['date_naissance']));
   }*/

   public function civilite() {
      return $this->hasOne('App\Civilite', 'id', 'civilite_id');
   }

   public function regime() {
      return $this->hasOne('App\Regime', 'id', 'regime_id');
   }

   public function situationFamiliale() {
      return $this->hasOne('App\Situation_familiale', 'id', 'situation_familiale_id');
   }

   public function details() {
      return $this->hasOne('App\Details_personne', 'personne_id', 'id');
   }

   public function conjoint() {
      /*return DB::select("select p.*,pp.id as id_relation from personnes p , personne_personnes pp where pp.personne_concerne_id = p.id
                        and pp.personne_id = " . $this->id . " and pp.type_relation='conjoint' and pp.deleted_at IS NULL ");
   */
      $idConjoint = Personne_personne::where('personne_id', '=', $this->id)->where('type_relation', '=', 'conjoint')->pluck('personne_concerne_id');
      if(sizeof($idConjoint) > 0) {
         return Personne::where('id', '=', $idConjoint)->first();
      } else {
         return null;
      }


   }


   public function age() {
      return Carbon::parse($this->date_naissance)->diff(\Carbon\Carbon::now())->format('%y');
   }

   public function enfants() {
      $idsEnfantsP = $idsEnfantsC = array();

      $idsEnfantsP = Personne_personne::where('personne_id', '=', $this->id)->where('type_relation', '=', 'enfant')->pluck('personne_concerne_id')->toArray();;
      if(!is_null($this->conjoint())) {
         $idsEnfantsC = Personne_personne::where('personne_id', '=', $this->conjoint()->id)->where('type_relation', '=', 'enfant')->pluck('personne_concerne_id')->toArray();;
      }
      $idsEnfants = array_merge($idsEnfantsC, $idsEnfantsP);
      //dd($idsEnfants);
      if(sizeof($idsEnfants) > 0) {
         $personnes = Personne::whereIn('id', $idsEnfants)->get();
         foreach($personnes as $personne) {
            $checkPersonne = Personne_personne::where('personne_concerne_id', '=', $personne->id)
               ->first();
            $personne->id_relation = $checkPersonne->id;

            if($checkPersonne->personne_id == $this->id) {
               $personne->ayant_droit = 'prospect';
            } else {
               $personne->ayant_droit = 'conjoint';
            }
         }
         return $personnes;
      } else {
         return null;
      }

      /*return DB::select("select p.*,pp.id as id_relation from personnes p , personne_personnes pp where pp.personne_concerne_id = p.id
                       and pp.personne_id = " . $this->id . " and pp.type_relation='enfant' and pp.deleted_at IS NULL ");
      */
   }


   /*public function fiche() {
      return $this->belongsTo('App\Fiche','user_id');
   }*/

   public function fiches() {
      return $this->hasMany('App\Fiche', 'personne_id', 'id');
   }


}
