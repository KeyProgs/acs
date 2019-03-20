<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formule extends Model {
   use SoftDeletes;
   protected $fillable = ['id', 'nom', 'description', 'gamme_id', 'logo'];
   protected $dates = ['created_at', 'updated_at', 'deleted_at'];

   public function gamme() {
      return $this->belongsTo('App\Gamme', 'gamme_id', 'id');
   }

   public function GetGAmme() {

      return Gamme::where('id', '=', $this->gamme_id)->first();
   }


}



