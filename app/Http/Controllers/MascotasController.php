<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\Usuario; // Asegúrate de importar el modelo correctamente
use App\Models\Perdido;
use App\Models\Adopcion;
use Illuminate\Support\Facades\Storage;

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
            // Logging para depuración
            \Log::info('Datos recibidos en store:', $request->all());

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

            // Manejar la imagen si se proporcionó una
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
                $imagen->move(public_path('storage/mascotas'), $nombreImagen);
                $mascota->imagen = 'mascotas/' . $nombreImagen;
                \Log::info('Imagen guardada como:', ['ruta' => $mascota->imagen]);
            }

            // Guardar y verificar
            $guardado = $mascota->save();
            \Log::info('Resultado de guardar:', ['guardado' => $guardado, 'id' => $mascota->id ?? 'no-id']);

            return redirect()->route('adopcion')
                ->with('success', 'Mascota registrada exitosamente');

        } catch (\Exception $e) {
            \Log::error('Error en store: ' . $e->getMessage());
            \Log::error('Trace: ' . $e->getTraceAsString());
            return back()
                ->withInput()
                ->with('error', 'Error al registrar la mascota: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validación de campos
            $request->validate([
                'nombre' => 'required|string|max:100',
                'especie' => 'required|in:perro,gato,otro',
                'edad' => 'required|integer|min:0',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Encontrar la mascota
            $mascota = Mascota::findOrFail($id);

            // Verificar que el usuario es el propietario o un admin
            if (auth()->id() !== $mascota->usuario_id && auth()->user()->rol !== 'admin') {
                return back()->with('error', 'No tienes permiso para editar esta mascota');
            }

            // Actualizar los datos de la mascota
            $mascota->nombre = $request->nombre;
            $mascota->especie = $request->especie;
            $mascota->edad = $request->edad;
            $mascota->usuario_id = auth()->id(); // Siempre usar el usuario autenticado

            // Manejo de la imagen
            if ($request->hasFile('imagen')) {
                // Eliminar imagen anterior si existe
                if ($mascota->imagen) {
                    Storage::disk('public')->delete($mascota->imagen);
                }

                // Almacenamiento de la nueva imagen
                $imagenPath = $request->file('imagen')->store('mascotas', 'public');
                $mascota->imagen = $imagenPath;
            }

            // Guardar los cambios
            $mascota->save();

            \Log::info('Mascota actualizada: ID '.$mascota->id);

            // Redirección a la página de adopción
            return redirect()->route('adopcion')
                ->with('success', 'Mascota actualizada exitosamente.');
        } catch (\Exception $e) {
            \Log::error('Error al actualizar mascota: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Error al actualizar la mascota: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Encontrar la mascota
            $mascota = Mascota::findOrFail($id);

            // Verificar permiso (opcional, puedes conservar esta validación si la necesitas)
            if (auth()->id() !== $mascota->usuario_id && auth()->user()->rol !== 'admin') {
                return back()->with('error', 'No tienes permiso para eliminar esta mascota');
            }

            // Guardar información para el mensaje
            $nombre = $mascota->nombre;

            // Eliminar la imagen si existe
            if ($mascota->imagen && Storage::disk('public')->exists($mascota->imagen)) {
                Storage::disk('public')->delete($mascota->imagen);
            }

            // Eliminar la mascota
            $mascota->delete();

            // Redireccionar a la página de adopción con mensaje de éxito
            return redirect()->route('adopcion')->with('success', "La mascota '$nombre' ha sido eliminada exitosamente");
        }
        catch (\Exception $e) {
            \Log::error('Error al eliminar mascota: ' . $e->getMessage());
            return back()->with('error', 'Error al eliminar la mascota');
        }
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

