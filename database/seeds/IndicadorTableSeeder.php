<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndicadorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Indicador')->insert([
            'Clave' => '1',
            'Descripcion' => 'Dinero',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Indicador')->insert([
            'Clave' => '2',
            'Descripcion' => 'Tiempo',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Indicador')->insert([
            'Clave' => '3',
            'Descripcion' => 'Unidades Producidas',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Indicador')->insert([
            'Clave' => '4',
            'Descripcion' => 'Calidad',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Indicador')->insert([
            'Clave' => '5',
            'Descripcion' => 'Nivel de Servicio',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Indicador')->insert([
            'Clave' => '6',
            'Descripcion' => 'Porcentaje',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
    }
}
