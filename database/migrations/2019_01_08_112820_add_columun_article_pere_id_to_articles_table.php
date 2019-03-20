<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumunArticlePereIdToArticlesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('articles', function(Blueprint $table) {
         $table->integer('article_pere_id')->nullable()->unsigned()->after('id');
         $table->foreign('article_pere_id')->references('id')->on('articles');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('articles', function(Blueprint $table) {
         //
      });
   }
}
