<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('escort_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->string('path')->nullable();
            $table->integer('views')->default(0);
            $table->integer('duration')->default(0);
            $table->string('type')->nullable();

            $table->foreign('escort_id')->references('id')->on('escorts')->onDelete('cascade');
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
        Schema::dropIfExists('videos');
    }
}
