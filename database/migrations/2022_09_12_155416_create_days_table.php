<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('order')->default(100)->nullable();
            $table->timestamps();
        });

        Schema::create('escort_day', function (Blueprint $table) {
            $table->bigInteger('escort_id')->unsigned()->index();
            $table->integer('day_id')->unsigned()->index();
            $table->string('name')->nullable();
            $table->integer('order')->default(100)->nullable();
            $table->time('from')->nullable();
            $table->time('to')->nullable();
            $table->timestamps();

            $table->foreign('escort_id')->references('id')->on('escorts')->onDelete('cascade');
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escort_day');
        Schema::dropIfExists('days');
    }
}
