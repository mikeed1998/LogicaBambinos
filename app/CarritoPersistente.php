<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarritoPersistente extends Model
{
    protected $fillable = [
        'usuario', 'carrito', 'cotizado',
    ];
}
