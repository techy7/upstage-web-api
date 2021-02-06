<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id')->nullable();
            $table->unsignedInteger('chat_id')->nullable();  
            $table->unsignedInteger('user_id')->nullable();
            $table->string('sender')->comment('user | editor')->nullable();
            $table->string('hash')->nullable();
            $table->string('slug')->nullable(); 
            $table->text('body');
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
}
