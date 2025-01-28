<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Representante;
use App\Models\Estudiante;
use App\Models\Pago;
use App\Models\Tpago;
use App\Models\Aescolar;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pago>
 */
class PagoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $repre = Representante::pluck('id')->toArray();
        $estu = Estudiante::pluck('id')->toArray();
        $tpagos = Tpago::pluck('id')->toArray();
        $aescolars = Aescolar::pluck('id')->toArray();

        return [
            'cantidad' => fake()->numberBetween(30,35),
            'dolar' => fake()->numberBetween(50,55),
            'fecha' => fake()->date("Y-m-d"),
            'representante_id' => fake()->randomElement($repre),
            'estudiante_id' => fake()->randomElement($estu),
            'tpago_id' => fake()->randomElement($tpagos),
            'aescolar_id' => fake()->randomElement($aescolars)
        ];
    }
}