<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\Usuario; // Asegúrate de importar el modelo correctamente
use App\Models\Perdido;
use App\Models\Adopcion;

class MascotasController extends Controller
{
    public function index()
    {
        $mascotas = Mascota::paginate(10);
        $perdidos = Perdido::paginate(10);
        $adopciones = Adopcion::with('mascota')->paginate(10);

        return view('mascotas.index', compact('mascotas', 'perdidos', 'adopciones'));
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

      //  dd($mascota); // Depuración

        if (!$mascota) {
            return redirect()->route('mascotas.index')->with('error', 'Mascota no encontrada.');
        }

        $usuarios = Usuario::all();
        return view('mascotas.edit', compact('mascota', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'required|in:perro,gato,otro',
            'edad' => 'required|integer|min:0',
            'usuario_id' => 'required|exists:usuarios,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $mascota = new Mascota($request->except('imagen'));

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('mascotas', 'public');
            $mascota->imagen = $path; // Guarda solo el path relativo
        }

        $mascota->save();

        return redirect()->route('mascotas.index')
            ->with('success', 'Mascota registrada exitosamente.');
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

