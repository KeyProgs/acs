<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipe extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'valeur', 'libelle', 'description'
   ];

   protected $dates = [
      'deleted_at',
      'updated_at',
      'deleted_at'
   ];

   public function users() {
      $usersInEquipeIds = User_equipe::where('equipe_id', '=', $this->id)->pluck('user_id');
      $users = User::whereIn('id', $usersInEquipeIds)->get();
      return $users;
   }
}
