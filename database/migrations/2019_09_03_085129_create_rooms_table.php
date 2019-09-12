<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('home_type');
            $table->string('room_type');
            $table->tinyInteger('accomodate');
            $table->tinyInteger('bedroom');
            $table->tinyInteger('bathroom');
            $table->integer('price')->nullable();
            $table->string('listing_name')->nullable();
            $table->string('summary')->nullable();
            $table->string('address')->nullable();
            $table->double('longtitude', 9, 6)->nullable();
            $table->double('latitude', 8, 6)->nullable();
            $table->boolean('has_tv')->nullable();
            $table->boolean('has_kitchen')->nullable();
            $table->boolean('has_internet')->nullable();
            $table->boolean('has_heating')->nullable();
            $table->boolean('has_air_conditioning')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table){
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('rooms');
    }
}
