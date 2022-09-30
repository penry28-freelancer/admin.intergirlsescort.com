<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('phone', 20);
            $table->string('address')->nullable();
            $table->string('zip_code');
            $table->integer('city_id');
            $table->integer('country_id')->unsigned();

            $table->string('company_name')->nullable();
            $table->string('identity_number')->nullable();
            $table->string('vat_id')->nullable();

            $table->integer('billable_id')->unsigned();
            $table->string('billable_type');

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
        Schema::dropIfExists('bills');
    }
}
