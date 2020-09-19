<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edited_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename')->nullable();
            $table->string('mimetype')->nullable(); 
            $table->unsignedInteger('listing_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('editor_id')->nullable();
            $table->unsignedInteger('item_id')->nullable();
            $table->string('hash')->nullable(); 
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('editor_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('edited_items');
    }

    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            $hashids = new Hashids('EditedItem', 8, 'ab1cd2ef3gh4ij5kl6mn7op8qr9st0uvwxyz');
            $strHash = $hashids->encode($model->id); 
            $model->hash = $strHash; 
            $model->save();
        });
    }
}
