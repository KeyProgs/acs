<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_messages', function (Blueprint $table) {
           $table->integer('user_id')->unsigned()->nullable();
           $table->foreign('user_id')->references('id')->on('users');

           $table->integer('message_id')->unsigned()->nullable();
           $table->foreign('message_id')->references('id')->on('messages');

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
        Schema::dropIfExists('user_messages');
    }
}
