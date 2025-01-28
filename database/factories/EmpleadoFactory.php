<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipo = ['Obrero','Docente','Dierctivo','Administrativo'];

        return [
            'cedula' => fake()->unique()->numberBetween(1000000,100000000),
            'nombre' => fake()->name(),
            'segundo' => fake()->name(),
            'paterno' => fake()->name(),
            'materno' => fake()->name(),
            'direccion' => fake()->text(255),
            'tipo' => fake()->randomElement($tipo)
        ];
    }
}
