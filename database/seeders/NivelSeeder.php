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
            ['nombre' => 'maternal prescolar'],
            ['nombre' => '1er nivel prescolar'],
            ['nombre' => '2do nivel prescolar'],
            ['nombre' => '3er nivel prescolar'],
            ['nombre' => '1er grado basica'],
            ['nombre' => '2do grado basica'],
            ['nombre' => '3er grado basica'],
            ['nombre' => '4to grado basica'],
            ['nombre' => '5to grado basica'],
            ['nombre' => '6to grado basica'],
            ['nombre' => '1er año media general'],
            ['nombre' => '2do año media general'],
            ['nombre' => '3er año media general'],
            ['nombre' => '4to año media general'],
            ['nombre' => '5to año media general']
        ];        

        foreach ($filas as $fila){
            Nivel::create($fila);
        }
    }
}
