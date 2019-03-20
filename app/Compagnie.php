<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compagnie extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'nom', 'adresse1', 'adresse2', 'ville_id', 'telephone1', 'telephone2', 'description', 'logo', 'chatel', 'resil'
   ];

   protected $dates = [
      'created_at', 'updated_at', 'deleted_at',
   ];

   public function gammes() {
      return $this->hasMany('App\Gamme', 'compagnie_id', 'id');
   }

   public function ville() {
      return $this->hasOne('App\Ville', 'id', 'ville_id');
   }

   public function piece_jointes() {
      return $this->hasMany('App\Piece_jointe', 'compagnie_id', 'id');
   }


}
