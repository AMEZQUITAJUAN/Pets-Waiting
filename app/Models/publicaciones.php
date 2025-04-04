<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publicaciones extends Model
{
    use HasFactory;
    public function adopcion(){
        return $this->hasMany('App\Models\adopciones');
    }
    public function comentario(){
        return $this->hasMany('App\Models\comentarios');
    }
    public function reaccion(){
        return $this->hasMany('App\Models\reacciones');
    }
    public function usuario(){
        return $this->belongsToMany('App\Models\usuarios');
    }
}
