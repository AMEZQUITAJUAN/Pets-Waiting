<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\Usuario; // Asegúrate de importar el modelo correctamente

class MascotasController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::paginate(10); // Paginación para usuarios
        $mascotas = Mascota::with('usuario')->get(); // Cargar mascotas con sus usuarios asociados
        return view('mascotas.index', compact('usuarios', 'mascotas'));
    }
    public function create()
    {
        return view('mascotas.create');
    }

}

