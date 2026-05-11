<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planta extends Model
{
    protected $fillable = [
        'nombre',
        'especie',
        'descripcion',
        'fecha_registro',
    ];
}
