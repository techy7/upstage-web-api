<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('editor_id')->nullable(); 
            $table->string('user_status')->default('new')->comment('new | seen');
            $table->string('editor_status')->default('new')->comment('new | seen');
            $table->string('hash')->nullable();
            $table->string('slug')->nullable(); 
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('editor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
