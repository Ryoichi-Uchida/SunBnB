<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reviewer_id');
            $table->unsignedInteger('reviewed_id');
            $table->string('reviewer_type');
            $table->unsignedInteger('room_id');
            $table->unsignedInteger('reservation_id');
            $table->tinyInteger('star');
            $table->string('comment')->nullable();
            $table->timestamps();

            $table->foreign('reviewer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('reviewed_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('cascade');

            $table->foreign('reservation_id')
                ->references('id')
                ->on('user_room')
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
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['reviewer_id', 'reviewed_id', 'room_id', 'user_room_id']);
        });

        Schema::dropIfExists('reviews');
    }
}
