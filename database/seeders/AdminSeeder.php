<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Usuario::create([
            'nombre' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'admin123', // Será hasheado automáticamente por el mutador
            'rol' => 'admin'
        ]);
    }
}
