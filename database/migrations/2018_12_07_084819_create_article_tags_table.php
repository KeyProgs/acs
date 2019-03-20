<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTagsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('article_tags', function(Blueprint $table) {
         $table->increments('id');

         $table->integer('tag_id')->unsigned()->nullable();
         $table->foreign('tag_id')->references('id')->on('tags');

         $table->integer('article_id')->unsigned()->nullable();
         $table->foreign('article_id')->references('id')->on('articles');

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
      Schema::dropIfExists('article_tags');
   }
}
