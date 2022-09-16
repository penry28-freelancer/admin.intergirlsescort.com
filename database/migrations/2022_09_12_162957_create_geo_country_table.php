<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_country', function (Blueprint $table) {
            $table->bigInteger('escort_id')->unsigned()->index();
            $table->integer('country_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('escort_id')->references('id')->on('escorts')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_country');
    }
}
