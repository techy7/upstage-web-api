<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename')->nullable();
            $table->string('mimetype')->nullable(); 
            $table->unsignedInteger('listing_id')->nullable();
            $table->unsignedInteger('user_id')->nullable(); 
            $table->unsignedInteger('item_id')->nullable();
            $table->string('hash')->nullable(); 
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); 
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('set null');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layers');
    }
}
