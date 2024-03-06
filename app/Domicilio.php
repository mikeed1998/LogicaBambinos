<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    protected $fillable = [
        'usuario',
        'alias',
        'calle',
        'numero_exterior',
        'numero_interior',
        'pais',
        'estado',
        'municipio',
        'colonia',
        'codigo_postal',
        'predeterminado',
    ];
}
