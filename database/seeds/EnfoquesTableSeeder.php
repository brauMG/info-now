<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnfoquesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Enfoques')->insert([
            'Clave' => '1',
            'Descripcion' => 'Calidad',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Enfoques')->insert([
            'Clave' => '2',
            'Descripcion' => 'Calidad',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Enfoques')->insert([
            'Clave' => '3',
            'Descripcion' => 'Gente',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Enfoques')->insert([
            'Clave' => '4',
            'Descripcion' => 'Costo',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Enfoques')->insert([
            'Clave' => '5',
            'Descripcion' => 'Servicio',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Enfoques')->insert([
            'Clave' => '6',
            'Descripcion' => 'Crecimiento',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
    }
}
