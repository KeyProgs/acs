<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('emetteur_id')->unsigned()->nullable();
           $table->foreign('emetteur_id')->references('id')->on('users');
           $table->string('email_emetteur',50);
           $table->longText('message');
           $table->date('date_debut')->nullable();
           $table->date('date_fin')->nullable();
           $table->integer('type_id')->unsigned();
           $table->foreign('type_id')->references('id')->on('message_types');
           $table->timestamps();
           $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            //
        });
    }
}
