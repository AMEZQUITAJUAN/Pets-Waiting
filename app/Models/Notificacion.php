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

    public function adopcion()
    {
        return $this->belongsTo(Adopcion::class, 'referencia_id')
                    ->where('referencia_tipo', 'App\Models\Adopcion');
    }

    public function perdido()
    {
        return $this->belongsTo(Perdido::class, 'referencia_id')
                    ->where('referencia_tipo', 'App\Models\Perdido');
    }
}
