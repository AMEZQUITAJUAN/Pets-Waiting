<?php

namespace App\Http\Controllers;

use App\Models\Usuario;

class OrmController extends Controller
{
    public function consultas()
    {
        $usuario = Usuario::find(1);
        return $usuario;
    }
}
