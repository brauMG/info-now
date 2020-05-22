<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtapaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Etapas', function (Blueprint $table) {
            $table->bigIncrements('Clave');
            $table->bigInteger('Clave_Proyecto');
            $table->bigInteger('Clave_Fase');
            $table->string('Descripcion');
            $table->date('Fecha_Vencimiento');
            $table->time('Hora_Vencimiento');
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
        Schema::table('Etapas', function (Blueprint $table) {
            //
        });
    }
}
