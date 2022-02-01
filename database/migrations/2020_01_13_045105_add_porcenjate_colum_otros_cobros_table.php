<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPorcenjateColumOtrosCobrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('otros_cobros', function (Blueprint $table) {
            $table->decimal('porcenjatetasa' , 10, 3)->after('valor')->nullable();
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
            $table->dropColumn('porcenjatetasa');
        });
    }
}
