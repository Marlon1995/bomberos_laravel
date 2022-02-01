<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumDescriptionSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('system', function (Blueprint $table) {
            $table->string('descripcion')->after('nombre')->nullable();
            $table->bigInteger('estado')->after('condiciones')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system', function (Blueprint $table) {
            $table->dropColumn('descripcion');
            $table->dropColumn('estado');
        });
    }
}
