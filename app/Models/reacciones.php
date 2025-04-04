<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reacciones extends Model
{
    use HasFactory;
    public function usuario(){
        return $this->belongsTo('App\Models\usuarios');
    }
}
