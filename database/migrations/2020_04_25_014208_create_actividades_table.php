<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Actividades', function (Blueprint $table) {
            $table->bigIncrements('Clave');
            $table->bigInteger('Clave_Compania');
            $table->bigInteger('Clave_Proyecto');
            $table->bigInteger('Clave_Fase');
            $table->string('Descripcion', 150);
            $table->string('FechaAccion', 50);
            $table->string('Decision', 250)->unique();
            $table->bigInteger('Clave_Status');
            $table->string('Contrasena', 250);
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
        Schema::dropIfExists('Actividades');
    }
}
