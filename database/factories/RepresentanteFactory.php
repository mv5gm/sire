<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Representante>
 */
class RepresentanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cedula' => fake()->unique()->numberBetween(1000000,100000000),
            'nombre' => fake()->name(),
            'segundo' => fake()->name(),
            'paterno' => fake()->name(),
            'materno' => fake()->name(),
            'direccion' => fake()->text(255),
                    
        ];
    }
}
