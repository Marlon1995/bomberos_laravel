<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumArchivoOtrosPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('otros_pagos', function (Blueprint $table) {
            $table->text('docRespaldo')->after('numPermisoFuncionamiento')->nullable();
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
            $table->dropColumn('docRespaldo');
        });
    }
}
