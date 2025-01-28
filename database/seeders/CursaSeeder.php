<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cursa;

class CursaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filas = [
            'aescolar_id' => 1,
            'seccion_id' => 1,
            'nivel_id' => 1,
            'salon_id' => 1
        ];        

        Cursa::create($filas);  
    }
}
