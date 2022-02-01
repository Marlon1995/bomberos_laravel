<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('denominacion_id');
            $table->bigInteger('riesgo_id');
            $table->bigInteger('tasaAnual_id');
            $table->decimal('valorPromedio', 10,2);
            $table->bigInteger('estado');
            $table->timestamps();
        });
    }
/*
 tasa

categoria_id



estado

 */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasas');
    }
}
