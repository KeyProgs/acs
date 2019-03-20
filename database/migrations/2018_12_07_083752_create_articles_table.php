<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('articles', function(Blueprint $table) {
         $table->increments('id');

         $table->string('titre', 150);
         $table->string('slug', 150);
         $table->longText('contenu');

         $table->integer('user_id')->unsigned()->nullable();
         $table->foreign('user_id')->references('id')->on('users');

         $table->integer('personne_id')->unsigned()->nullable();
         $table->foreign('personne_id')->references('id')->on('personnes');

         $table->integer('article_statut_id')->unsigned()->nullable();
         $table->foreign('article_statut_id')->references('id')->on('article_status');

         $table->timestamps();
         $table->timestamp('deleted_at')->nullable();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::dropIfExists('articles');
   }
}
