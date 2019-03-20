<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'department_code', 'insee_code', 'zip_code', 'name', 'slug', 'gps_lat', 'gps_lng'
    ];

    public function departement()
    {
        return $this->hasOne('App\Departement', 'id', 'department_code');
    }

    function getCodeDepFromCP($cp)
    {
        $Departement_Code = $Departement_Code = Ville::where('zip_code', $cp)->first()->department_code;
        if ($Departement_Code != null)
            return $Departement_Code;
        else
            dd("$Departement_Code Departement_Code introuvable");


    }
}
