<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $table = 'mascotas'; // Asegúrate de que el nombre de la tabla sea correcto

    protected $fillable = ['nombre', 'especie', 'edad', 'usuario_id'];

    public function usuario(){
        return $this->belongsTo('App\Models\Usuario');
    }
    public function getRouteKeyName()
    {
        return 'nombre';
    }    
}
