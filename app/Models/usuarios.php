<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuarios extends Model
{
    use HasFactory;
    public function mascota(){
        return $this->hasMany('App\Models\mascotas');
    }
    public function donacion(){
        return $this->hasMany('App\Models\donaciones');
    }
    public function adopcion(){
        return $this->hasMany('App\Models\adopciones');
    }
    public function comentario(){
        return $this->hasMany('App\Models\comentarios');
    }
    public function reaccion(){
        return $this->hasMany('App\Models\reacciones');
    }
    public function publicacion(){
        return $this->belongsToMany('App\Models\pulicaciones');
    }
}
