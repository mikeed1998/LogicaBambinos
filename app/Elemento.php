<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    protected $fillable = [
		'elemento','texto','imagen','url','activo','orden','seccion',
	];
}
