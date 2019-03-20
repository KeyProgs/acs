<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumunPersonneIdToSimualtionsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('simulations', function(Blueprint $table) {
         $table->integer('personne_id')->unsigned()->nullable()->after('user_id');
         $table->foreign('personne_id')->references('id')->on('personnes');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('simulations', function(Blueprint $table) {
         //
      });
   }
}
