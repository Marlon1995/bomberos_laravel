<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumYearOtrosPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('otros_pagos', function (Blueprint $table) {
            $table->bigInteger('year_now')->after('formaPago_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('otros_pagos', function (Blueprint $table) {
            $table->dropColumn('year_now');
        });
    }
}
