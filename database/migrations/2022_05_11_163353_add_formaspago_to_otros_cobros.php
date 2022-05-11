<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormaspagoToOtrosCobros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('otros_cobros', function (Blueprint $table) {
            $table->string('formaspago')->after('descripcion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('otros_cobros', function (Blueprint $table) {
            $table->dropColumn('formaspago');
        });
    }
}
