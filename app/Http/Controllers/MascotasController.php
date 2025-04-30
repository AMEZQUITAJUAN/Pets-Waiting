<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\Usuario; // Asegúrate de importar el modelo correctamente

class MascotasController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('id', 'desc')->paginate(10); // Paginación para usuarios
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

    public function edit($id)
    {
        $mascota = Mascota::find($id);

        dd($mascota); // Depuración

        if (!$mascota) {
            return redirect()->route('mascotas.index')->with('error', 'Mascota no encontrada.');
        }

<<<<<<< HEAD
        $usuarios = Usuario::all();
=======
        $usuarios = Usuario::all(); // Obtener todos los usuarios
         dd($usuarios); // Descomentar esta línea si necesitas depurar $usuarios
>>>>>>> 85a2f60a97f990df304a8d65b3138a03fb9969dd
        return view('mascotas.edit', compact('mascota', 'usuarios'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'required|in:perro,gato,otro',
            'edad' => 'required|integer|min:0',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        // Crear la nueva mascota
        Mascota::create($request->all());

        // Redirigir a la lista de mascotas con un mensaje de éxito
        return redirect()->route('mascotas.index')->with('success', 'Mascota registrada exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'required|in:perro,gato,otro',
            'edad' => 'required|integer|min:0',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        $mascota = Mascota::findOrFail($id);
        $mascota->update($request->all());

        return redirect()->route('mascotas.index')->with('success', 'Mascota actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $mascota = Mascota::findOrFail($id);
        $mascota->delete();

        return redirect()->route('mascotas.index')->with('success', 'Mascota eliminada exitosamente.');
    }
}

