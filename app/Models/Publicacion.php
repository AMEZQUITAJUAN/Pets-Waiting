<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;
    public function adopcion(){
        return $this->hasMany('App\Models\Adopcion');
    }
    public function comentario(){
        return $this->hasMany('App\Models\Comentario');
    }
    public function reaccion(){
        return $this->hasMany('App\Models\Reaccion');
    }
    public function usuario(){
        return $this->belongsToMany('App\Models\Usuario');
    }
}
