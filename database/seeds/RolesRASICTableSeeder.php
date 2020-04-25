<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesRASICTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('RolesRASIC')->insert([
            'Clave' => 'R',
            'RolRASIC' => 'Responsable',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('RolesRASIC')->insert([
            'Clave' => 'A',
            'RolRASIC' => 'Aprobador',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('RolesRASIC')->insert([
            'Clave' => 'S',
            'RolRASIC' => 'Soporte',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('RolesRASIC')->insert([
            'Clave' => 'I',
            'RolRASIC' => 'Informar',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('RolesRASIC')->insert([
            'Clave' => 'C',
            'RolRASIC' => 'Consultar',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
    }
}
