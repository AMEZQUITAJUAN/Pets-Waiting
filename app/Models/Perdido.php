<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perdido extends Model
{
    use HasFactory;

    protected $table = 'perdidos';

    protected $fillable = [
        'nombre',
        'especie',
        'raza',
        'descripcion',
        'ubicacion',
        'fecha_perdida',
        'contacto',
        'imagen',
        'usuario_id',
        'estado'
    ];

    protected $casts = [
        'fecha_perdida' => 'date'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
