<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundacion extends Model
{
    use HasFactory;
    public function donacion(){
        return $this->hasMany('App\Models\Donacion');
    }
}
