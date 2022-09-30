<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname')->nullable();
            $table->integer('club_id')->unsigned();
            $table->integer('rating')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('is_verified')->default(0);
            $table->timestamps();

            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('club_reviews');
    }
}
