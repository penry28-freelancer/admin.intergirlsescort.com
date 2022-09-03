<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escorts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('organization')->nullable();
            $table->date('last_seen_online_at')->nullable();
            $table->text('bio')->nullable();
            $table->tinyText('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('location')->nullable();

            $table->integer('eyes_id')->nullable();
            $table->integer('hair_color_id')->nullable();
            $table->integer('hair_length_id')->nullable();
            $table->integer('public_hair_id')->nullable();
            $table->integer('bust_size_id')->nullable();
            $table->integer('bust_type_id')->nullable();
            $table->integer('travel_id')->nullable();
            $table->integer('height_id')->nullable();
            $table->integer('ethnicity_id')->nullable();
            $table->integer('orientation_id')->nullable();
            $table->integer('smoker_id')->nullable();
            $table->integer('nationality_id')->nullable();
            $table->text('service_content')->nullable();
            $table->string('available_for')->nullable();
            $table->string('meeting_with')->nullable();
            $table->string('phone')->nullable();
            $table->integer('country_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->boolean('is_verified')->default(0);
            $table->boolean('is_top')->default(0);
            $table->boolean('is_vip')->default(0);
            $table->bigInteger('video_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escorts');
    }
}
