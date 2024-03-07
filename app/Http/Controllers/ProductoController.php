<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::where('activo', 1)->where('visible', 1)->get();
        return view('front.productos', compact('productos'));
    }
}
