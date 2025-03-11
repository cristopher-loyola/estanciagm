<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Agregar esta línea

class AreaSeeder extends Seeder
{
    public function run()
    {
        DB::table('areas')->insert([
            ['nombre' => 'Biblioteca'],
            ['nombre' => 'Informatica'],
            ['nombre' => 'DAV'],
            ['nombre' => 'Por definir']
        ]);
    }
}