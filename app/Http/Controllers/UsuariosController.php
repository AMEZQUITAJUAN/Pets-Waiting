<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuariosController extends Controller
{
    public function create() {
        return view('usuarios.create');
    }

    public function store(Request $request) {
        $request->validate([
            'Nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:8',
        ]);

        $usuario = new Usuario();
        $usuario->Nombre = $request->Nombre;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        return redirect()->route('usuarios.index');
    }

    public function index() {
        $usuarios = Usuario::paginate(10); // 10 usuarios por página
        return view('usuarios.index', compact('usuarios'))->with('links', $usuarios->links());
    }
}
