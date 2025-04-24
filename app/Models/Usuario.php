<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'email',
        'password',
    ];
   

    public function mascotas()
    {
        return $this->hasMany(Mascotas::class);
    }

    public function donaciones()
    {
        return $this->hasMany(Donaciones::class);
    }

    public function adopciones()
    {
        return $this->hasMany(Adopciones::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentarios::class);
    }

    public function reacciones()
    {
        return $this->hasMany(Reacciones::class);
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicaciones::class);
    }
}

