<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEquipeTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('equipes', function(Blueprint $table) {
         $table->string('tel1')->after("agence")->nullable();
         $table->string('tel2')->after("tel1")->nullable();
         $table->string('tel3')->after("tel2")->nullable();
         
         $table->integer('ville_id')->unsigned()->after('tel3')->nullable();
         $table->foreign('ville_id')->references('id')->on('villes');

         $table->longText('adresse1')->after("ville_id")->nullable();
         $table->longText('adresse2')->after("adresse1")->nullable();
         $table->string('email')->after("adresse2")->nullable();
         $table->string('code_postal')->after("email")->nullable();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('equipes', function(Blueprint $table) {
         //
      });
   }
}
