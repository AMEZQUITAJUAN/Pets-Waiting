<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuariosController extends Controller
{
    public function create()
    {
        return view('formulario'); // Cargar la vista del formulario
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6',
        ]);
        Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encriptar la contraseña
        ]);

        return redirect()->route('mascotas.index')->with('success', 'Usuario registrado exitosamente.');
    }

    public function index() {
        $usuarios = Usuario::paginate(10); // 10 usuarios por página
        return view('usuarios.index', compact('usuarios'))->with('links', $usuarios->links());
    }

    public function showUsuarioWithMascotas($id) {
        $usuario = Usuario::with('mascotas')->find($id); // Reemplaza $id con el ID que necesites
        return view('usuarios.show', compact('usuario'));
    }
}
