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
            $table->integer('agency_id')->unsigned()->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->text('perex')->nullable();
            $table->string('sex')->nullable();
            $table->integer('birt_year')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('hair_lenght')->nullable();
            $table->string('bust_size')->nullable();
            $table->string('bust_type')->nullable();
            $table->string('provides1')->nullable();
            $table->integer('nationality_counter_id')->unsigned()->nullable();
            $table->string('travel')->nullable();
            $table->string('available_for')->nullable();
            $table->integer('dick_size')->nullable();

            // languages
            $table->string('tattoo')->nullable();
            $table->string('piercing')->nullable();
            $table->string('smoker')->nullable();
            $table->string('eye')->nullable();
            $table->string('orientation')->nullable();
            $table->string('hair_pubic')->nullable();
            $table->integer('pornstar')->nullable();
            $table->text('verify_text')->nullable();
            $table->text('provides')->nullable();
            $table->string('meeting_with')->nullable();
            $table->string('website')->nullable();

            // Phone
            $table->string('phone1_code')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone1_viber')->nullable();
            $table->string('phone1_whatsapp')->nullable();
            $table->string('phone1_wechat')->nullable();
            $table->string('phone1_telegram')->nullable();
            $table->string('phone1_lineapp')->nullable();
            $table->string('phone1_signal')->nullable();
            $table->string('phone1_wechatid')->nullable();
            $table->string('phone1_lineappid')->nullable();
            $table->string('phone1_telegramid')->nullable();

            $table->string('phone2_code')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone2_viber')->nullable();
            $table->string('phone2_whatsapp')->nullable();
            $table->string('phone2_wechat')->nullable();
            $table->string('phone2_telegram')->nullable();
            $table->string('phone2_lineapp')->nullable();
            $table->string('phone2_signal')->nullable();
            $table->string('phone2_wechatid')->nullable();
            $table->string('phone2_lineappid')->nullable();
            $table->string('phone2_telegramid')->nullable();
            // geo_country_id

            // Section 2
            $table->string('video')->nullable();

            // Section 3
            $table->integer('counter_currency_id')->unsigned()->nullable();
            $table->float('rate_incall_30')->nullable();
            $table->float('rate_outvall_30')->nullable();
            $table->float('rate_incall_1')->nullable();
            $table->float('rate_outvall_1')->nullable();
            $table->float('rate_incall_2')->nullable();
            $table->float('rate_outvall_2')->nullable();
            $table->float('rate_incall_3')->nullable();
            $table->float('rate_outvall_3')->nullable();
            $table->float('rate_incall_6')->nullable();
            $table->float('rate_outvall_6')->nullable();
            $table->float('rate_incall_12')->nullable();
            $table->float('rate_outvall_12')->nullable();
            $table->float('rate_incall_24')->nullable();
            $table->float('rate_outvall_24')->nullable();
            $table->float('rate_incall_48')->nullable();
            $table->float('rate_outvall_48')->nullable();
            $table->float('rate_incall_24_second')->nullable();
            $table->float('rate_outvall_24_second')->nullable();

            // Section 5
            $table->string('timezone')->nullable();
            $table->timestamps();

            $table->bigInteger('belong_escort_id')->unsigned()->nullable();

            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('nationality_counter_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('counter_currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('belong_escort_id')->references('id')->on('escort')->onDelete('cascade');
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
