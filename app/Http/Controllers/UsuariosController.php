<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuariosController extends Controller
{  public function create(){

    return view('usuarios.create');


}

public function store(Request $request){


    $usuario = new usuario();
    $usuario->Nombre=$request->Nombre;
    $usuario->email=$request->email;
    $usuario->contraseña=$request->contraseña;
    $usuario->telefono=$request->telefono;
    $usuario->save();
    return $usuario;
}
}
