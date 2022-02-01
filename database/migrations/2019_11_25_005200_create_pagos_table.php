<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    public function up()
    {
        Schema::create('pagos_tasas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('client_id');
            $table->bigInteger('tasa_anual_id');
            $table->bigInteger('estado');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('pagos_tasas');
    }
}
