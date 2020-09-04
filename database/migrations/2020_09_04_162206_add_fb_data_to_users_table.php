<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFbDataToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('fb_id')->nullable();
            $table->string('fb_email')->nullable();
            $table->string('fb_name')->nullable();
            $table->string('fb_avatar')->nullable();
            $table->longText('fb_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['fb_id', 'fb_email', 'fb_name', 'fb_avatar', 'fb_token']);
        });
    }
}
