<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsTableTasaAnual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasa_anual', function (Blueprint $table) {
            $table->bigInteger('categoria_id')->after('id')->nullable();
            $table->bigInteger('riesgo_id')->after('categoria_id')->nullable();
            $table->bigInteger('denominacion_id')->after('riesgo_id')->nullable();
            $table->decimal('otrosGads', 10,2)->after('denominacion_id')->nullable();
            $table->decimal('valTasaAnual', 10,2)->after('otrosGads')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasa_anual', function (Blueprint $table) {
            $table->dropColumn('categoria_id');
            $table->dropColumn('riesgo_id');
            $table->dropColumn('denominacion_id');
            $table->dropColumn('otrosGads');
            $table->dropColumn('valTasaAnual');
         });
    }
}
