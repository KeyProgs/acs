<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('bases', function(Blueprint $table) {
         $table->increments('id');
         $table->string('parametre_nom', 150);
         $table->longText('parametre_valeur')->nullable();
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
      Schema::dropIfExists('bases');
   }
}
