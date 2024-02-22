<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoGaleria extends Model
{
    protected $fillable = [
        'producto', 'imagen',
    ];
}
