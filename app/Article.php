<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model {
   use SoftDeletes;
   use Sluggable;
   protected $fillable = [
      'id', 'titre', 'slug', 'contenu', 'user_id', 'personne_id', 'article_statut_id'
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];

   public function sluggable() {
      return [
         'slug' => [
            'source' => 'titre'
         ]
      ];
   }
}
