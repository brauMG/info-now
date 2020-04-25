<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Proyectos', function (Blueprint $table) {
            $table->bigIncrements('Clave');
            $table->bigInteger('Clave_Compania');
            $table->string('Descripcion', 150);
            $table->bigInteger('Clave_Usuario');
            $table->bigInteger('Clave_Area');
            $table->bigInteger('Clave_Fase');
            $table->bigInteger('Clave_Enfoque');
            $table->bigInteger('Clave_Trabajo');
            $table->bigInteger('Clave_Indicador');
            $table->string('Objectivo', 250);
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
        Schema::dropIfExists('Proyectos');

    }
}
