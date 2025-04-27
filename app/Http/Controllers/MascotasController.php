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
        $mascotas = Mascota::with('usuario')->paginate(10); // Paginación para mascotas con sus usuarios asociados
        return view('mascotas.index', compact('usuarios', 'mascotas'));
    }

    public function create()
    {
        $usuarios = Usuario::all(); // Obtener todos los usuarios
        return view('mascotas.create', compact('usuarios'));
    }

    public function show($id)
    {
        $mascota = Mascota::with('usuario')->find($id);

        if (!$mascota) {
            return redirect()->route('mascotas.index')->with('error', 'Mascota no encontrada.');
        }

        return view('mascotas.show', compact('mascota'));
    }
}

