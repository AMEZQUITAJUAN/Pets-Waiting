<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Adopcion;
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
        $validated = $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'ciudad' => 'required|string|max:255',
            'ocupacion' => 'required|string|max:255',
            'tipoMascota' => 'required|string',
            'razas' => 'nullable|string|max:255',
            'porque' => 'required|string',
        ]);

        try {
            Adopcion::create([
                'mascota_id' => $validated['mascota_id'],
                'nombre' => $validated['nombre'],
                'email' => $validated['email'],
                'telefono' => $validated['telefono'],
                'ciudad' => $validated['ciudad'],
                'ocupacion' => $validated['ocupacion'],
                'tipo_mascota' => $validated['tipoMascota'],
                'razas' => $validated['razas'],
                'porque' => $validated['porque'],
                'estado' => 'pendiente'
            ]);
            return redirect()->back()->with('success', 'Tu solicitud de adopción ha sido enviada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Hubo un error al enviar tu solicitud. Por favor, intenta nuevamente.']);
        }
    }
}

