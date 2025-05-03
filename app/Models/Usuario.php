<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

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

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRolToUsuariosTable extends Migration
{
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('rol')->default('user'); // Valores: 'admin' o 'user'
        });
    }

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn('rol');
        });
    }
}

