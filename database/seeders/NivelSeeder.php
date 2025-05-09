<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nivel;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filas = [
            ['nombre' => 'Maternal Pre-Escolar', 'categoria' => 'Inicial'],
            ['nombre' => '1er nivel Pre-Escolar', 'categoria' => 'Inicial'],
            ['nombre' => '2do nivel Pre-Escolar', 'categoria' => 'Inicial'],
            ['nombre' => '3er nivel Pre-Escolar', 'categoria' => 'Inicial'],
            ['nombre' => '1er grado basica','categoria' => 'Basica'],
            ['nombre' => '2do grado basica','categoria' => 'Basica'],
            ['nombre' => '3er grado basica','categoria' => 'Basica'],
            ['nombre' => '4to grado basica','categoria' => 'Basica'],
            ['nombre' => '5to grado basica','categoria' => 'Basica'],
            ['nombre' => '6to grado basica','categoria' => 'Basica'],
            ['nombre' => '1er año media general','categoria' => 'Media General'],
            ['nombre' => '2do año media general','categoria' => 'Media General'],
            ['nombre' => '3er año media general','categoria' => 'Media General'],
            ['nombre' => '4to año media general','categoria' => 'Media General'],
            ['nombre' => '5to año media general','categoria' => 'Media General']
        ];        

        foreach ($filas as $fila){
            Nivel::create($fila);
        }
    }
}
