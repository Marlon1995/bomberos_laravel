<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client', function (Blueprint $table) {
            $table->string('referencia')->after('telefono')->nullable();
            $table->dropColumn('pagoLicenciaTurismo');
            $table->dropColumn('pagoPatente');
            $table->dropColumn('fotosLocal_id');
            $table->dropColumn('impstPredial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client', function (Blueprint $table) {
            $table->dropColumn('referencia');
         });
    }
}
