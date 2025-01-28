<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Representante;


class RepresentanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Representante::factory(100)->create();
    }
}
