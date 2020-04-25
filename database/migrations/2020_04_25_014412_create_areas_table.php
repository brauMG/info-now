<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Areas', function (Blueprint $table) {
            $table->bigIncrements('Clave');
            $table->bigInteger('Clave_Compania');
            $table->string('Descripcion', 250);
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
        Schema::dropIfExists('Areas');

    }
}
