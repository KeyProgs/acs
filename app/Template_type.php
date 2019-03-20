<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template_type extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'type'
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];
}
