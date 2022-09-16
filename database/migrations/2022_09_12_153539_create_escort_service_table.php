<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscortServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escort_service', function (Blueprint $table) {
            $table->bigInteger('escort_id')->unsigned()->index();
            $table->integer('service_id')->unsigned()->index();
            $table->boolean('is_included')->default(0);
            $table->float('extra_price')->nullable();
            $table->timestamps();

            $table->foreign('escort_id')->references('id')->on('escorts')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escort_service');
    }
}
