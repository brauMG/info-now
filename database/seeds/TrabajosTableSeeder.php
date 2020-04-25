<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrabajosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Trabajos')->insert([
            'Clave' => '1',
            'Descripcion' => 'Operaciones',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Trabajos')->insert([
            'Clave' => '2',
            'Descripcion' => 'Administrativo',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Trabajos')->insert([
            'Clave' => '3',
            'Descripcion' => 'Proyectos',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
        DB::table('Trabajos')->insert([
            'Clave' => '4',
            'Descripcion' => 'Iniciativas',
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1'
        ]);
    }
}
