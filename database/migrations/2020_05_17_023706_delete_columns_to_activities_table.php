<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColumnsToActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Actividades', function (Blueprint $table) {
            $table->dropColumn('Clave_Fase');
            $table->dropColumn('Clave_Status');
            $table->dropColumn('Contrasena');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Actividades', function (Blueprint $table) {
            $table->integer('Clave_Fase');
            $table->integer('Clave_Status');
            $table->integer('Contrasena');
        });
    }
}
