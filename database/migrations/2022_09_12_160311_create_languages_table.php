<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('escort_language', function (Blueprint $table) {
            $table->bigInteger('escort_id')->unsigned()->index();
            $table->integer('language_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('escort_id')->references('id')->on('escorts')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escort_language');
        Schema::dropIfExists('languages');
    }
}
