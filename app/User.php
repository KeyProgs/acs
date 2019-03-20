<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable {
   use Notifiable;
   use SoftDeletes;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $guard = 'user';

   protected $fillable = [
      'id',
      'role_id',
      'nom',
      'prenom',
      'titre',
      'email',
      'telephone',
      'adresse',
      'date_naissance',
      'photo',
      'commentaire',
      'email_verified_at',
      'password'
   ];

   protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at',
   ];
   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
      'password', 'remember_token',
   ];


   public function role() {
      return $this->hasOne('App\Role', 'id','role_id');
   }




   public function isRole($role){
      return $this->role()->where('valeur','=', $role)->exists();
   }

   /*public function isAdmin($role) {
      return $this->role()->where('valeur','=', 'admin')->exists();
   }

   public function isSuperVisor() {
      return $this->role()->where('valeur', 'supervisor')->exists();
   }

   public function isAgent() {
      return $this->role()->where('valeur', 'agent')->exists();
   }*/


   public function fiches() {
      return $this->hasMany('App\Fiche','user_id');
   }

   public function user_type_assurance() {
      return $this->hasMany('App\User_type_assurance', 'user_id', 'id');
   }

   public function simulations() {
      return $this->hasMany('App\Simulation','user_id','id');
   }


   //get all users in equipe by role User
   public function getUsersEquipeByUser($userId) {

      $user = User::findOrFail($userId);
      $usersIds = array();
      if($user->isRole('agent')) {
         $usersIds[0] = $userId;
      } elseif($user->isRole('admin')) {
         $usersIds = User::all()->pluck('id');
      } else {
         $equipesIdsByUser = User_equipe::where('user_id', '=', $userId)->pluck('equipe_id');
         $usersIds = User_equipe::whereIn('equipe_id', $equipesIdsByUser)->pluck('user_id');
      }
      return $usersIds;
   }



   //



}
