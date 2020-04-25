<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RolesProyectos', function (Blueprint $table) {
            $table->bigIncrements('Clave');
            $table->bigInteger('Clave_Proyecto');
            $table->bigInteger('Clave_Fase');
            $table->string('Clave_Rol_RASIC', 10);
            $table->bigInteger('Clave_Usuario');
            $table->dateTime('FechaCreacion');
            $table->tinyInteger('Activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RolesProyectos');

    }
}
