<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteFromUsersPassEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Usuarios', function (Blueprint $table) {
            $table->dropColumn('Contrasena');
            $table->dropColumn('Correo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Usuarios', function (Blueprint $table) {
            $table->string('Contrasena');
            $table->string('Correo');
        });
    }
}
