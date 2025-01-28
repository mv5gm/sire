<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seccion;

class SeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filas = [ 
            ['nombre' => 'A'],
            ['nombre' => 'B'],
            ['nombre' => 'C'],
            ['nombre' => 'D'],
            ['nombre' => 'E'],
            ['nombre' => 'F'],
            ['nombre' => 'G'],
            ['nombre' => 'H'],
            ['nombre' => 'I'],
            ['nombre' => 'J'],
            ['nombre' => 'K'],
            ['nombre' => 'L'],
            ['nombre' => 'M'],
            ['nombre' => 'N'],
            ['nombre' => 'Ñ'],
            ['nombre' => 'O'],
            ['nombre' => 'P'],
            ['nombre' => 'Q'],
            ['nombre' => 'R'],
            ['nombre' => 'S'],
            ['nombre' => 'T'],
            ['nombre' => 'U'],
            ['nombre' => 'V'],
            ['nombre' => 'W'],
            ['nombre' => 'X'],
            ['nombre' => 'Y'],
            ['nombre' => 'Z']
        ];  

        foreach ($filas as $fila) {
            Seccion::create($fila);
        }
    }
}
