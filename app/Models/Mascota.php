<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $table = 'mascotas';

    protected $fillable = [
        'nombre',
        'especie',
        'edad',
        'imagen',
        'usuario_id'
    ];

    public function adopcion()
    {
        return $this->hasMany('App\Models\Adopcion');
    }

    public function usuario(){
        return $this->belongsTo('App\Models\Usuario');
    }

    public function getRouteKeyName()
    {
        return 'id'; // Cambiado a 'id' para evitar problemas con rutas
    }
}
