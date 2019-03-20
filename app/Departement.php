<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model {
   protected $fillable = [
      'id', 'region_code', 'code', 'name', 'slug'
   ];
}
