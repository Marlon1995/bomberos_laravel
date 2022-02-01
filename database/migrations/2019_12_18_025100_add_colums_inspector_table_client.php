<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsInspectorTableClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * INSPECTOR QUE REGISTRA EL FOMRUIARIO
     */
    public function up()
    {
        Schema::table('client', function (Blueprint $table) {
            $table->bigInteger('inspector_id')->after('send_email')->nullable();
            $table->text('decripcion')->after('inspector_id')->nullable();
            $table->text('file')->after('decripcion')->nullable();
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
            $table->dropColumn('inspector_id');
            $table->dropColumn('decripcion');
            $table->dropColumn('file');
        });
    }
}
