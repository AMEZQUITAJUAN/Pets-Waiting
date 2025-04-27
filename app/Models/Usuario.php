<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Usuario extends Model
{
    use HasFactory;

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }

    public function donaciones()
    {
        return $this->hasMany(Donacion::class);
    }

    public function adopciones()
    {
        return $this->hasMany(Adopcion::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function reacciones()
    {
        return $this->hasMany(Reaccion::class);
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class);
    }
}

//$usuario = Usuario::with('mascotas')->find($id);

