<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UbicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 1. Insertar Regiones
        // Esto crea ID 1: Costa, ID 2: Sierra, ID 3: Amazonía
        \DB::table('regiones')->insert([
            ['nombre' => 'Costa'],
            ['nombre' => 'Sierra'],
            ['nombre' => 'Amazonía'],
        ]);

        // 2. Insertar Ciudades usando los IDs de las regiones
        \DB::table('ciudades')->insert([
            ['nombre' => 'Guayaquil', 'region_id' => 1],
            ['nombre' => 'Quito', 'region_id' => 2],
            ['nombre' => 'Cuenca', 'region_id' => 2],
            ['nombre' => 'Manta', 'region_id' => 1],
            ['nombre' => 'Tena', 'region_id' => 3],
        ]);
    }
}
