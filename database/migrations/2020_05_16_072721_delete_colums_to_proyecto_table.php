<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColumsToProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Proyectos', function (Blueprint $table) {
            $table->dropColumn('Clave_Usuario');
            $table->dropColumn('Clave_Area');
            $table->dropColumn('Clave_Area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Proyectos', function (Blueprint $table) {
            //
        });
    }
}
