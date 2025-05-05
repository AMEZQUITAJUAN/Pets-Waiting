<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;

class AdopcionesController extends Controller
{
    public function index()
    {
        $mascotas = Mascota::with('usuario')->latest()->paginate(6);
        return view('adopcion', compact('mascotas'));
    }

    public function create($mascota)
    {
        $mascota = Mascota::findOrFail($mascota);
        return view('frmadopcion', compact('mascota'));
    }

    // Procesar datos del formulario
    public function store(Request $request)
    {
        // Validar la data
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'tipoMascota' => 'required|string',
            'razas' => 'nullable|string|max:100',
            'porque' => 'nullable|string',
        ]);

        // Aquí puedes guardar los datos en la base de datos, enviar email, etc.
        // Ejemplo: Adopcion::create($validated);

        return view('frmadopcion', compact('mascotas'));
    }
}

