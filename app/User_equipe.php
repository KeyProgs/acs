<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_equipe extends Model {
   use SoftDeletes;
   protected $fillable = [
      'user_id',
      'equipe_id'
   ];
   protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at'
   ];

   protected $primaryKey = 'user_id';

   public function user() {
      return $this->belongsTo('App\User', 'user_id', 'id');
   }

   public function equipe() {
      return $this->belongsTo('App\Equipe', 'equipe_id', 'id');
   }

}
