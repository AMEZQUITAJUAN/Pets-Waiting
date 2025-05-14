<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'tipo',
        'mensaje',
        'url',
        'leido',
        'referencia_id',
        'referencia_tipo'
    ];

    protected $casts = [
        'leido' => 'boolean',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
