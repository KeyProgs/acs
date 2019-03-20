<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Piece_jointe extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'formule_id', 'gamme_id', 'compagnie_id', 'fiche_id', 'devis_id', 'url', 'description'
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];
   //
}
