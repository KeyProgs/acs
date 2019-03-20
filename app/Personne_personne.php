<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personne_personne extends Model {
   use SoftDeletes;

   //protected $table = "personne_personnes";
   protected $fillable = [
      'personne_id', 'personne_concerne_id', 'type_relation'
   ];

   protected $dates = [
      'created_at', 'deleted_at', 'deleted_at'
   ];

   public function personne_concerne() {
      return $this->belongsTo('App\Personne', 'personne_concerne_id');
   }
}
