<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address')->nullable();
            $table->integer('country_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->integer('calling_country_id_1')->nullable()->unsigned();
            $table->string('phone_1')->nullable();
            $table->boolean('is_viber_1')->default(0);
            $table->boolean('is_whatsapp_1')->default(0);
            $table->string('wechat_1')->nullable();
            $table->string('telegram_1')->nullable();
            $table->string('line_1')->nullable();
            $table->boolean('is_signal_1')->default(0);
            $table->integer('calling_country_id_2')->nullable()->unsigned();
            $table->string('phone_2')->nullable();
            $table->boolean('is_viber_2')->default(0);
            $table->boolean('is_whatsapp_2')->default(0);
            $table->string('wechat_2')->nullable();
            $table->string('telegram_2')->nullable();
            $table->string('line_2')->nullable();
            $table->boolean('is_signal_2')->default(0);
            $table->string('banner_url')->nullable();
            $table->timestamps();

            $table->integer('account_id')->unsigned()->nullable();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('calling_country_id_1')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('calling_country_id_2')->references('id')->on('countries')->onDelete('cascade');
        });

        Schema::create('club_hours', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('club_id')->unsigned();
            $table->timestamps();

            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');
        });}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clubs');
        Schema::dropColumns('club_hours', [
            'title',
            'club_id',
        ]);
    }
}