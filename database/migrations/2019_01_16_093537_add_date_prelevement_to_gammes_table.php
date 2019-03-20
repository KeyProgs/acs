<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatePrelevementToGammesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('gammes', function(Blueprint $table) {
         $table->string('date_prelevement', 150)->nullable()->after('annee');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('gammes', function(Blueprint $table) {
         //
      });
   }
}
