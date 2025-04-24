<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(), // Genera un nombre aleatorio
            'email' => $this->faker->unique()->safeEmail(), // Genera un email único
            'password' => bcrypt('password'), // Contraseña encriptada
            
        ];
    }
}
