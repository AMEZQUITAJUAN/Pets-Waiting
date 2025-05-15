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
            // Crear la adopción
            $adopcion = Adopcion::create([
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

            // Obtener la mascota y su dueño
            $mascota = Mascota::findOrFail($validated['mascota_id']);

            // Crear mensaje para la notificación
            $mensaje = "Solicitud de adopción para {$mascota->nombre}:\n" .
                       "Nombre: {$validated['nombre']}\n" .
                       "Email: {$validated['email']}\n" .
                       "Teléfono: {$validated['telefono']}\n" .
                       "Ciudad: {$validated['ciudad']}\n" .
                       "Ocupación: {$validated['ocupacion']}\n" .
                       "Motivo: " . substr($validated['porque'], 0, 100) .
                       (strlen($validated['porque']) > 100 ? '...' : '');

            // Crear notificación para el dueño de la mascota
            \App\Models\Notificacion::create([
                'usuario_id' => $mascota->usuario_id,
                'tipo' => 'adopcion',
                'mensaje' => $mensaje,
                'url' => route('notificaciones.show', $adopcion->id),
                'leido' => false,
                'referencia_id' => $adopcion->id,
                'referencia_tipo' => 'App\Models\Adopcion'
            ]);

            return redirect()->back()->with('success', 'Tu solicitud de adopción ha sido enviada correctamente. El dueño será notificado.');
        } catch (\Exception $e) {
            \Log::error('Error al crear solicitud de adopción: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Hubo un error al enviar tu solicitud. Por favor, intenta nuevamente.']);
        }
    }
}

