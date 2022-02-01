<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRiesgos extends Migration
{
    public function up()
    {
        Schema::table('riesgos', function (Blueprint $table) {
            $table->dropColumn('valor');
        });

    }

    public function down()
    {
        Schema::table('riesgos', function (Blueprint $table) {
            $table->bigInteger('valor')->nullable();
        });
    }
}
