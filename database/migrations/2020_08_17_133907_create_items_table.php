<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->text('description')->nullable();  
            $table->string('filename')->nullable();
            $table->string('mimetype')->nullable();
            $table->string('status')->comment('raw | edited'); 
            $table->unsignedInteger('listing_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('editor_id')->nullable();
            $table->string('hash')->nullable();
            $table->string('slug')->nullable(); 
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('editor_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
