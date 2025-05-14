<?php
namespace App\Http\Controllers;

use App\Models\Perdido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\NotificacionesController;
use App\Models\Notificacion;

class PerdidosController extends Controller
{
    public function __construct()
    {
        // Excluir index y show del middleware auth
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('admin')->only(['adminIndex']);
    }

    public function index()
    {
        $perdidos = Perdido::latest()->paginate(10);
        return view('perdidos.index', compact('perdidos'));
    }

    public function adminIndex()
    {
        $perdidos = Perdido::orderBy('created_at', 'desc')->paginate(10);
        return view('perdidos.perdidos_admin_index', compact('perdidos'));
    }

    public function create()
    {
        return view('perdidos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'required|in:perro,gato,otro',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string',
            'fecha_perdida' => 'required|date',
            'contacto' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $perdido = new Perdido($request->except('imagen'));
            $perdido->usuario_id = auth()->id(); // Agregar esta línea

            if ($request->hasFile('imagen')) {
                $path = $request->file('imagen')->store('perdidos', 'public');
                $perdido->imagen = $path;
            }

            $perdido->save();

            return redirect()->route('perdidos.index')
                ->with('success', 'Mascota perdida registrada exitosamente');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function show(Perdido $perdido)
    {
        return view('perdidos.show', compact('perdido'));
    }

    public function edit(Perdido $perdido)
    {
        return view('perdidos.edit', compact('perdido'));
    }

    public function update(Request $request, Perdido $perdido)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'required|in:perro,gato,otro',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string',
            'fecha_perdida' => 'required|date',
            'contacto' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $perdido->fill($request->except('imagen'));

        if ($request->hasFile('imagen')) {
            if ($perdido->imagen) {
                Storage::disk('public')->delete($perdido->imagen);
            }
            $path = $request->file('imagen')->store('perdidos', 'public');
            $perdido->imagen = $path;
        }

        $perdido->save();

        return redirect()->route('perdidos.index')
            ->with('success', 'Mascota perdida actualizada exitosamente');
    }

    public function destroy(Perdido $perdido)
    {
        if ($perdido->imagen) {
            Storage::disk('public')->delete($perdido->imagen);
        }

        $perdido->delete();

        return redirect()->route('perdidos.index')
            ->with('success', 'Registro eliminado exitosamente');
    }

    public function reportarEncontrada(Request $request, $id)
    {
        try {
            $perdido = Perdido::findOrFail($id);

            // Verificar que la mascota esté actualmente perdida
            if ($perdido->estado !== 'perdido') {
                return back()->with('error', 'Esta mascota ya ha sido reportada como encontrada anteriormente.');
            }

            // Detalles sobre cómo se encontró
            $ubicacion = $request->input('ubicacion', 'No especificada');
            $detalles = $request->input('detalles', 'No se proporcionaron detalles adicionales.');

            // Cambiar estado a encontrado
            $perdido->estado = 'encontrado';
            $perdido->save();

            // Crear notificación para el dueño
            $mensaje = "¡Buenas noticias! Tu mascota {$perdido->nombre} ha sido reportada como encontrada. Ubicación: {$ubicacion}";
            if (!empty($detalles)) {
                $mensaje .= ". Detalles: {$detalles}";
            }

            // Guardar la notificación directamente sin instanciar el controlador
            Notificacion::create([
                'usuario_id' => $perdido->usuario_id,
                'tipo' => 'encontrado',
                'mensaje' => $mensaje,
                'url' => route('perdidos.show', $perdido->id),
                'leido' => false,
                'referencia_id' => $perdido->id,
                'referencia_tipo' => 'App\Models\Perdido'
            ]);

            return redirect()->route('perdidos.show', $perdido->id)
                ->with('success', 'Mascota reportada como encontrada. Se ha notificado al dueño.');
        } catch (\Exception $e) {
            \Log::error('Error al reportar mascota encontrada: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al reportar la mascota como encontrada.');
        }
    }
}
