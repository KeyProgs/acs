<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id',
      'emetteur_id',
      'emetteur_email',
      'message',
      'date_debut',
      'date_fin',
      'type_id',
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];

}
