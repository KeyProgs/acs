<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model {
   protected $fillable = [
      'id', 'action', 'type_action_id'
   ];
   protected $dates = [
      'craated_at', 'updated', 'deleted_at'
   ];

   public function type_action() {
      return $this->hasOne('App\Type_action', 'id', 'type_action_id');
   }
}
