<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Type_assurance extends Model {
   protected $fillable = [
      'id', 'nom', 'description'
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at',
   ];

   public function gammes() {
      return $this->hasMany('App\Gamme', 'type_assurance_id', 'id')->orderBy('compagnie_id');
   }
   public function gammesIds() {
      return DB::table('gammes')->where('type_assurance_id',$this->id)->get()->pluck('id');
      ////return $this->hasMany('App\Gamme', 'type_assurance_id', 'id')->columns('id')->orderBy('compagnie_id');
   }


   public function user_type_assurance() {
      return $this->hasMany('App\Gamme', 'type_assurance_id', 'id');
   }

}
