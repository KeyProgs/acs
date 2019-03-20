<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User_type_assurance extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'user_id', 'type_assurance_id'
   ];

   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];

   public function user() {
      return $this->belongsTo('App\User', 'user_id', 'id');
   }

   public function type_assurance() {
      return $this->belongsTo('App\Type_assurance', 'type_assurance_id', 'id');
   }

   public function get_user_type_assurance() {
      $results = DB::select("select uta.type_assurance_id  from users u , user_type_assurances uta where u.id = " . Auth::user()->id . " and uta.user_id = u.id ");
      $dataIds = [];
      foreach($results as $result) {
         array_push($dataIds, $result->type_assurance_id);
      }
      return $dataIds;
   }


}
