<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscostReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escost_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nick_name')->nullable();
            $table->string('name_of_escost')->nullable();
            $table->integer('country_id')->nullable()->unsigned();
            $table->integer('city_id')->nullable()->unsigned();
            $table->timestamp('date_added')->nullable();
            $table->integer('calling_country_id')->nullable()->unsigned();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escost_reports');
    }
}
