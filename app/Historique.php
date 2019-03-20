<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Historique extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'user_id','personne_id', 'fiche_id','devis_id', 'action_id','description','vue'
   ];
   protected $dates = [
      'craated_at', 'updated', 'deleted_at'
   ];

   public function user() {
      return $this->belongsTo('App\User', 'user_id', 'id');
   }

   public function fiche() {
      return $this->belongsTo('App\Fiche', 'fiche_id', 'id');
   }

   public function action() {
      return $this->hasOne('App\Action', 'id', 'action_id');
   }



}
