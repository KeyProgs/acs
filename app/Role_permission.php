<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role_permission extends Model {
   use SoftDeletes;
   protected $fillable = [
      'permission_id',
      'role_id',
   ];
   protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at'
   ];
}
