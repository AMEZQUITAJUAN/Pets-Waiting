<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;

class AdopcionesController extends Controller
{
    public function index()
    {
        $mascotas = Mascota::with('usuario')->latest()->paginate(6);
        return view('adopcion', compact('mascotas'));
    }
}

