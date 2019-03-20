<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_action extends Model {
   protected $fillable = [
      'id', 'type_action',
   ];
   protected $dates = [
      'craated_at', 'updated', 'deleted_at'
   ];

   public function actions() {
      return $this->hasMany('App\Action', 'type_action_id', 'id');
   }
}
