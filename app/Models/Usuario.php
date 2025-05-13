<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Mutador para hashear la contraseña
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    // Método para verificar la contraseña
    public function validatePassword($password)
    {
        return Hash::check($password, $this->password);
    }

    public function mascotas()
    {
        return $this->hasMany(Mascota::class, 'usuario_id');
    }

    public function perdidos()
    {
        return $this->hasMany(Perdido::class, 'usuario_id');
    }

    public function isAdmin()
    {
        return $this->rol === 'admin';
    }
}


