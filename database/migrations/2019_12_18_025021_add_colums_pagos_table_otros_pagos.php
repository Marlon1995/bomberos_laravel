<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsPagosTableOtrosPagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * ID DEL ISNPECTOR QUE REGISTRA
     */
    public function up()
    {
        Schema::table('otros_pagos', function (Blueprint $table) {
            $table->bigInteger('formaPago_id')->after('tipoPago')->nullable();
            $table->text('descripcion')->after('formaPago_id')->nullable();
            $table->bigInteger('numTransaccion')->after('descripcion')->nullable();
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
            $table->dropColumn('formaPago_id');
            $table->dropColumn('descripcion');
            $table->dropColumn('numTransaccion');
        });
    }
}
