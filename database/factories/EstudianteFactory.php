<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudiante>
 */
class EstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sexos = ['m','f'];

        return [
            'cedula' => fake()->unique()->numberBetween(1000000,100000000),
            'nombre' => fake()->name(),
            'segundo' => fake()->name(),
            'paterno' => fake()->name(),
            'materno' => fake()->name(),
            'fecha' => fake()->date('Y-m-d'),
            'sexo' => $sexos[rand(0,1)],
            'lugar' => fake()->name(),
            'cursa_id' => '1'
        ];
    }
}
