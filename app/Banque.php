<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banque extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id','nom', 'adresse', 'ville_id'
   ];

   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];

   public function ville(){
      return $this->hasOne('App\Ville', 'id', 'ville_id');
   }
}
