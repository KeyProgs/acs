<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Simulation extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'user_id', 'type_assurance_id', 'fiche_id', 'date_effet'
   ];

   protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at'
   ];

   /*public function setDateEffetAttribute($value) {
      $date_parts = explode('/', $value);
      $this->attributes['date_effet'] = $date_parts[2].'-'.$date_parts[1].'-'.$date_parts[0];
   }

   public function getDateEffetAttribute($value) {
      return date('d/m/Y', strtotime($this->attributes['date_effet']));
   }*/

   public function fiche() {
      return $this->belongsTo('App\Fiche', 'fiche_id', 'id');
   }

   public function devis3() {
      return $this->hasMany('App\Devis', 'simulation_id', 'id');
   }

   public function devis($id_devis = null, $var = false) {


      if(isset($id_devis)) {
         $devis = Devis::where('id', '=', $id_devis)->first();
      } else {
         $devis = $this->hasMany('App\Devis', 'simulation_id', 'id');
      }


      if($var == true) {
         return $this->getCompte($devis);
      } else {
         return $devis;
      }
   }

   public function fiche__(){
       return $this->hasOne('App\Fiches', 'id', 'fiche_id');
   }


   public function allDevis() {

      $devis = Devis::where('simulation_id', '=', $this->id)->get();
      return $this->hasMany('App\Devis', 'simulation_id', 'id');
   }

   public function getCompte() {

   }

   /*public function lastDevis() {
      return $this->hasOne('App\Devis','simulation_id','id')-();
   }*/


   public function user() {
      return $this->belongsTo('App\User', 'user_id');
   }

}
