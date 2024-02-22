<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCaracteristica extends Model
{
    protected $fillable = [
        'producto', 'caracteristica',
    ];
}
