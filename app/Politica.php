<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Politica extends Model
{
    protected $fillable = [
        'titulo', 'descripcion', 'archivo',
    ];
}
