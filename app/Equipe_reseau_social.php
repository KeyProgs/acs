<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipe_reseau_social extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'equipe_id', 'reseau_social_id', 'url', 'description'
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];
}
