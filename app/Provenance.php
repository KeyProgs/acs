<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provenance extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'valeur', 'libelle'
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];
}
