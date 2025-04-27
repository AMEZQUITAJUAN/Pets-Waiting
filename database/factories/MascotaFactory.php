<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mascota>
 */
class MascotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(), // Nombre ficticio de la mascota
            'especie' => $this->faker->randomElement(['perro', 'gato', 'otro']), // Especie válida
            'edad' => $this->faker->numberBetween(1, 15), // Edad entre 1 y 15 años
            'usuario_id' => \App\Models\Usuario::factory(), // Relación con un usuario ficticio
        ];
    }
}
