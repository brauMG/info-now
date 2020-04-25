<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CompaniasTableSeeder::class,
            EnfoquesTableSeeder::class,
            FasesTableSeeder::class,
            IndicadorTableSeeder::class,
            RolesRASICTableSeeder::class,
            RolesTableSeeder::class,
            StatusTableSeeder::class,
            TrabajosTableSeeder::class,
            UsuariosTableSeeder::class
        ]);
    }
}

