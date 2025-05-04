<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perdido extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'especie',
        'raza',
        'descripcion',
        'ubicacion',
        'fecha_perdida',
        'imagen',
        'contacto',
        'estado'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
