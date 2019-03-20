<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id',
      'permission',
      'description',
   ];
   protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at'
   ];
}
