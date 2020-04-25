<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesRasicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RolesRASIC', function (Blueprint $table) {
            $table->string('Clave');
            $table->string('RolRASIC', 150);
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
        Schema::dropIfExists('RolesRASIC');

    }
}
