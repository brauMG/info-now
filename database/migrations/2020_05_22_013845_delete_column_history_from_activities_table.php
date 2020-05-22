<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColumnHistoryFromActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Actividades', function (Blueprint $table) {
            $table->dropColumn('Orden');
            $table->dropColumn('Clave_Historial');
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
            $table->integer('Orden');
            $table->integer('Clave_Historial');
        });
    }
}
