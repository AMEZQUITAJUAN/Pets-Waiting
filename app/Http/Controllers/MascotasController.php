<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\Usuario; // Asegúrate de importar el modelo correctamente
use App\Models\Perdido;
use App\Models\Adopcion;

class MascotasController extends Controller
{
    public function __construct()
    {
        // Solo autenticación para create y store
        $this->middleware('auth')->only(['create', 'store']);
    }

    public function index()
    {
        $mascotas = Mascota::paginate(10);
        $perdidos = Perdido::paginate(10);
        $adopciones = Adopcion::with('mascota')->paginate(10);

        return view('mascotas.index', compact('mascotas', 'perdidos', 'adopciones'));
    }

    public function create()
    {
        try {
            if (!auth()->check()) {
                return redirect()->route('login')
                    ->with('error', 'Debes iniciar sesión para publicar una mascota');
            }

            \Log::info('Usuario accediendo a create: ' . auth()->id());
            return view('mascotas.create');
        } catch (\Exception $e) {
            \Log::error('Error en create: ' . $e->getMessage());
            return redirect()->route('adopcion')
                ->with('error', 'Error al cargar el formulario');
        }
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
        try {
            // Validar la solicitud
            $validated = $request->validate([
                'nombre' => 'required|string|max:100',
                'especie' => 'required|in:perro,gato,otro',
                'edad' => 'required|integer|min:0',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Crear la mascota con los datos validados
            $mascota = new Mascota();
            $mascota->nombre = $validated['nombre'];
            $mascota->especie = $validated['especie'];
            $mascota->edad = $validated['edad'];
            $mascota->usuario_id = auth()->id();
            $mascota->estado = 'disponible'; // Agregar estado por defecto

            // Manejar la imagen si se proporcionó una
            if ($request->hasFile('imagen')) {
                $path = $request->file('imagen')->store('public/mascotas');
                $mascota->imagen = str_replace('public/', '', $path);
            }

            // Guardar y verificar
            if (!$mascota->save()) {
                throw new \Exception('Error al guardar la mascota en la base de datos');
            }

            \Log::info('Mascota guardada exitosamente', [
                'id' => $mascota->id,
                'usuario_id' => $mascota->usuario_id
            ]);

            return redirect()->route('adopcion')
                ->with('success', 'Mascota registrada exitosamente');

        } catch (\Exception $e) {
            \Log::error('Error en store: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Error al registrar la mascota: ' . $e->getMessage());
        }
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

    public function adopcionIndex()
    {
        try {
            $mascotas = Mascota::with('usuario')
                ->latest()
                ->get();

            return view('adopcion', compact('mascotas'));
        } catch (\Exception $e) {
            \Log::error('Error cargando mascotas: ' . $e->getMessage());
            return back()->with('error', 'Error al cargar las mascotas');
        }
    }
}

