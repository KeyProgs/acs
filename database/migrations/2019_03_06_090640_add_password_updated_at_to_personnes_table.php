<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPasswordUpdatedAtToPersonnesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::table('personnes', function (Blueprint $table) {
         $table->timestamp("password_updated_at")->nullable()->after("password");
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::table('personnes', function (Blueprint $table) {
         //
      });
   }
}
