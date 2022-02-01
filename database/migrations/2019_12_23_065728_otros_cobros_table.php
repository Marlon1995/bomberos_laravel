<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OtrosCobrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otros_cobros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razonSocial')->nullable();
            $table->string('representanteLegal')->nullable();
            $table->string('ruc')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->bigInteger('formaPago_id')->nullable();
            $table->string('numTransaccion')->nullable();
            $table->string('descripcion')->nullable();
            $table->decimal('valor',13,3)->nullable();
            $table->bigInteger('estado')->nullable();
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
        Schema::dropIfExists('otros_cobros');

    }
}
