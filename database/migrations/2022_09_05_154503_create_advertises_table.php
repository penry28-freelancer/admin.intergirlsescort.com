<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('advertise_links', function (Blueprint $table) {
            $table->increments('id');
            $table->text('url')->nullable();
            $table->integer('advertise_id')->unsigned();
            $table->timestamps();

            $table->foreign('advertise_id')->references('id')->on('advertises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertise_links');
        Schema::dropIfExists('advertises');
    }
}
