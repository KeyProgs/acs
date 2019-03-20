<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Volet extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'valeur', 'description',
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];

   public function sousVolets() {
      return $this->hasMany('App\Sous_volet', 'volet_id', 'id');
   }

   public function getSousVoletsById($voletId) {
      $sousVolet = DB::table('sous_volets')
         //->join('valeurs', 'sous_volets.id', '=', 'valeurs.sous_volet_id')
         ->where('sous_volets.volet_id', '=', $voletId)
         //->whereIn('sous_volets.id', $sousVoletsIds)
         ->select('sous_volets.id', 'sous_volets.valeur')->get();
      if(sizeof($sousVolet) > 0) {
         return $sousVolet;
      } else {
         return null;
      }
   }
}
