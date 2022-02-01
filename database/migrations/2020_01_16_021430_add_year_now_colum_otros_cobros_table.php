<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddYearNowColumOtrosCobrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('otros_cobros', function (Blueprint $table) {
            $table->bigInteger('year_now' )->after('porcenjatetasa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('otros_cobros', function (Blueprint $table) {
            $table->dropColumn('porcenjatetasa');
        });
    }
}
