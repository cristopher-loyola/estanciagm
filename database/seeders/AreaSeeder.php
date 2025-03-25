<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // Importa Schema

class AreaSeeder extends Seeder
{
    public function run()
    {
        // Deshabilitar restricciones de llave foránea
        Schema::disableForeignKeyConstraints();
        
        // Eliminar todos los registros de la tabla
        DB::table('areas')->truncate();
        
        // Habilitar restricciones nuevamente
        Schema::enableForeignKeyConstraints();

        // Insertar nuevas áreas
        DB::table('areas')->insert([
            ['nombre' => 'Dir. General'],
            ['nombre' => 'Biblioteca'],
            ['nombre' => 'Administración'],
            ['nombre' => 'Planeación y Informática']
        ]);
    }
}