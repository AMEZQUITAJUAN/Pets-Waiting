<?php
namespace App\Http\Controllers;

use App\Models\Perdido;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerdidoController extends Controller
{
    public function index()
    {
        $perdidos = Perdido::with('usuario')->paginate(10);
        return view('perdidos.index', compact('perdidos'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        return view('perdidos.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'required|in:perro,gato,otro',
            'raza' => 'nullable|string|max:50',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string',
            'fecha_perdida' => 'required|date',
            'contacto' => 'required|string',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $perdido = new Perdido($request->except('imagen'));

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('perdidos', 'public');
            $perdido->imagen = $path;
        }

        $perdido->save();

        return redirect()->route('perdidos.index')
            ->with('success', 'Mascota perdida registrada exitosamente');
    }

    public function show($id)
    {
        $perdido = Perdido::with('usuario')->findOrFail($id);
        return view('perdidos.show', compact('perdido'));
    }

    public function edit($id)
    {
        $perdido = Perdido::findOrFail($id);
        $usuarios = Usuario::all();
        return view('perdidos.edit', compact('perdido', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'required|in:perro,gato,otro',
            'raza' => 'nullable|string|max:50',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string',
            'fecha_perdida' => 'required|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'usuario_id' => 'required|exists:usuarios,id',
            'estado' => 'required|in:perdido,encontrado'
        ]);

        $perdido = Perdido::findOrFail($id);
        $perdido->fill($request->except('imagen'));

        if ($request->hasFile('imagen')) {
            // Eliminar imagen antigua si existe
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

    public function destroy($id)
    {
        $perdido = Perdido::findOrFail($id);

        // Eliminar imagen si existe
        if ($perdido->imagen) {
            Storage::disk('public')->delete($perdido->imagen);
        }

        $perdido->delete();

        return redirect()->route('perdidos.index')
            ->with('success', 'Registro eliminado exitosamente');
    }
}
