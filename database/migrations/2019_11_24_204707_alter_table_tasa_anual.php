<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableTasaAnual extends Migration {
    public function up()
    {
        Schema::table('tasa_anual', function (Blueprint $table) {
            $table->dropColumn('anio');
            $table->dropColumn('valor');
        });
    }

    public function down()
    {
        Schema::table('tasa_anual', function (Blueprint $table) {
            $table->bigInteger('anio');
            $table->decimal('valor', 10,2);
        });
    }
}
