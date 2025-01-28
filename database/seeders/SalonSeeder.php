<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Salon;

class SalonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filas = [
            ['nombre' => 'Simon Bolivar']
        ];        

        foreach ($filas as $fila){
            Salon::create($fila);
        }
    }
}
