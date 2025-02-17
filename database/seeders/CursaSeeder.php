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
        $filas =  [ 
            [
                'aescolar_id' => 1,
                'seccion_id' => 1,
                'nivel_id' => 1,
                'salon_id' => 1
            ],
            [
                'aescolar_id' => 1,
                'seccion_id' => 1,
                'nivel_id' => 2,
                'salon_id' => 1
            ],
            [
                'aescolar_id' => 1,
                'seccion_id' => 1,
                'nivel_id' => 3,
                'salon_id' => 1
            ],
            [
                'aescolar_id' => 1,
                'seccion_id' => 1,
                'nivel_id' => 4,
                'salon_id' => 1
            ],
            [
                'aescolar_id' => 1,
                'seccion_id' => 1,
                'nivel_id' => 5,
                'salon_id' => 1
            ],
            [
                'aescolar_id' => 1,
                'seccion_id' => 1,
                'nivel_id' => 6,
                'salon_id' => 1
            ],
            [
                'aescolar_id' => 1,
                'seccion_id' => 1,
                'nivel_id' => 7,
                'salon_id' => 1
            ],
            [
                'aescolar_id' => 1,
                'seccion_id' => 1,
                'nivel_id' => 8,
                'salon_id' => 1
            ],
            [
                'aescolar_id' => 1,
                'seccion_id' => 1,
                'nivel_id' => 9,
                'salon_id' => 1
            ],
            [
                'aescolar_id' => 1,
                'seccion_id' => 1,
                'nivel_id' => 10,
                'salon_id' => 1
            ],
            [
                'aescolar_id' => 1,
                'seccion_id' => 1,
                'nivel_id' => 11,
                'salon_id' => 1
            ],
            [
                'aescolar_id' => 1,
                'seccion_id' => 1,
                'nivel_id' => 12,
                'salon_id' => 1
            ],
            [
                'aescolar_id' => 1,
                'seccion_id' => 1,
                'nivel_id' => 13,
                'salon_id' => 1
            ]
        ];        

        foreach ($filas as $key => $value) {
            Cursa::create($value);  
        }
    }   
}       