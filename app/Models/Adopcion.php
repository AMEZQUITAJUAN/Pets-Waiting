<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopcion extends Model
{
    use HasFactory;
    // Removed duplicate usuario method
protected $table = 'adopciones';

protected $fillable = [
        'mascota_id',
        'nombre',
        'email',
        'telefono',
        'ciudad',
        'ocupacion',
        'tipo_mascota',
        'razas',
        'porque',
        'estado'
    ];
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
