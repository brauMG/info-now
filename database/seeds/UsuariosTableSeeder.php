<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Usuarios')->insert([
            'Clave' => '1',
            'Clave_Compania' => '1',
            'Iniciales' => 'EG',
            'Nombres' => 'Enrique Gamez',
            'email' => 'veyriko@gmail.com',
            'Clave_Area' => null,
            'Clave_Puesto' => null,
            'Clave_Rol' => '1',
            'password' => Hash::make('asdasdasd'),
            'UltimoLogin' => null,
            'FechaCreacion' => date('Y-m-d H:i:s'),
            'Activo' => '1',
            'remember_token' => Str::random(10)
        ]);
    }
}
