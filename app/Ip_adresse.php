<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ip_adresse extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'adresse_ip', 'description', 'user_id'
   ];
   protected $dates = [
      'created_at', 'updated_at', 'updated_at'
   ];
}
