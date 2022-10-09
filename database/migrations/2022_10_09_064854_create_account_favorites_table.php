<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_favorites', function (Blueprint $table) {
            $table->integer('sender_id')->unsigned()->index();
            $table->integer('receiver_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_favorites');
    }
}
