<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'categoria', 'subcategoria', 'nombre', 'descripcion', 'frente', 'fondo', 'alto', 'portada', 'precio', 'anticipo',
    ];
}

