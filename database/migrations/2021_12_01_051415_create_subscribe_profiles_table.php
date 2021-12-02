<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribeProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribe_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscribe_from');
            $table->foreign('subscribe_from')->references('id')->on('users');
            $table->unsignedBigInteger('subscribe_to');
            $table->foreign('subscribe_to')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribe_profiles');
    }
}
