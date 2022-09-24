<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableEscortAddEmailPassword extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escorts', function (Blueprint $table) {
            $table->string('password', 100)->nullable()->after('name');
            $table->string('email')->unique()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('escorts', [
            'email',
            'password',
            'token',
        ]);
    }
}
