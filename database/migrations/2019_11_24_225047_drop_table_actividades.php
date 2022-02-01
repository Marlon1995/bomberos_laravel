<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTableActividades extends Migration
{
    public function up()
    {
        Schema::dropIfExists('actividades');
    }

    public function down()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->bigInteger('estado');
            $table->timestamps();
        });
    }
}
