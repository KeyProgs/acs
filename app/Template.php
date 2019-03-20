<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model {
   use SoftDeletes;
   protected $fillable = ['id', 'nom', 'type_id', 'template'];
   protected $dates = ['created_at', 'upadted_at', 'deleted_at'];

   public $Vars = array(
      "prospect" => array(
         "nom" => null,
         "prenom" => null,
         "regim" => null,
         "datenaissance" => null),
      "conjoint" => array(
         "conjoint_nom" => null,
         "conjoint_prenom" => null,
         "conjoint_regim" => null,
         "conjoint_datenaissance" => null),
      "enfants" => null,
      "dateeffect" => null,
      "Tel1" => null,
      "Tel2" => null,
      "Tel3" => null,
      "email" => null,
      "adresse" => null,
      "ville" => null,
   );

   public function type() {
      return $this->hasOne('App\Template_type', 'id', 'type_id');
   }

}
