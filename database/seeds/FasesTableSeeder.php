<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Fases')->insert([
            'Clave' => '1',
            'Descripcion' => 'Definición',
            'Orden' => '1',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Fases')->insert([
            'Clave' => '2',
            'Descripcion' => 'Medición',
            'Orden' => '2',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Fases')->insert([
            'Clave' => '3',
            'Descripcion' => 'Análisis',
            'Orden' => '3',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Fases')->insert([
            'Clave' => '4',
            'Descripcion' => 'Implementación',
            'Orden' => '4',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Fases')->insert([
            'Clave' => '5',
            'Descripcion' => 'Control',
            'Orden' => '5',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Fases')->insert([
            'Clave' => '6',
            'Descripcion' => 'Todas',
            'Orden' => '6',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
    }
}
