<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipeReseauSocialsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('equipe_reseau_socials', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('equipe_id')->unsigned()->nullable();
         $table->foreign('equipe_id')->references('id')->on('equipes');

         $table->integer('reseau_social_id')->unsigned()->nullable();
         $table->foreign('reseau_social_id')->references('id')->on('reseau_socials');

         $table->string('url');
         $table->longText('description')->nullable();

         $table->timestamps();
         $table->timestamp("deleted")->nullable();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::dropIfExists('equipe_reseau_socials');
   }
}
