<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpuestoTrimestralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impuesto_trimestral', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('trimestre')->nullable();
            $table->timestamp('fechaInicial')->nullable();
            $table->timestamp('fechaFinal')->nullable();
            $table->decimal('porcentaje', '10','2')->nullable();
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
        Schema::dropIfExists('impuesto_trimestral');
    }
}
