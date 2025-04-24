<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuariosController extends Controller
{
    public function create() {
        return view('formulario'); // Sin espacio al final
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

    }

    public function index() {
        $usuarios = Usuario::paginate(10); // 10 usuarios por página
        return view('usuarios.index', compact('usuarios'))->with('links', $usuarios->links());
    }
}
