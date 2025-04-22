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
        $usuario = new Usuario();
        $usuario->Nombre = $request->Nombre;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password); // Encriptar la contraseña
        $usuario->telefono = $request->telefono;
        $usuario->save();

        return redirect()->route('usuarios.index');
    }

    public function index() {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }
}
