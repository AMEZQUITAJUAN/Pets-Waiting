<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuariosController extends Controller
{  public function create(){

    return view('usuarios.create');


}

public function store(Request $request){


    $usuario = new usuario();
    $usuario->name=$request->name;
    $usuario->price=$request->password;
    $usuario->save();
    return $usuario;
}
}
