<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tipoFormulario');
            $table->string('razonSocial');
            $table->string('ruc');
            $table->string('representanteLegal');
            $table->bigInteger('parroquia_id');
            $table->bigInteger('barrio_id');
            $table->string('telefono');
            $table->bigInteger('actividad_id');
            $table->bigInteger('categoria_id');
            $table->bigInteger('impstPredial');
            $table->bigInteger('pagoLicenciaTurismo');
            $table->bigInteger('pagoPatente');
            $table->bigInteger('fotosLocal_id');
            $table->bigInteger('estado');
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
        Schema::dropIfExists('client');
    }
}
