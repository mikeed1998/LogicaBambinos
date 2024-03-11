<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Configuracion;
use App\Seccion;
use App\Elemento;
use App\Categoria;
use App\Producto;
use App\ProductoGaleria;
use App\ProductoCaracteristica;


class FrontController extends Controller
{
    public function home()
    {
        return view('front.index');
    }

    public function aboutus()
    {
        return view('front.index');
    }

    public function contact()
    {
        return view('front.index');
    }

    public function tienda() {
        $categorias = Categoria::all();
        $productos = Producto::where('activo', 1)->where('visible', 1)->get();
        $producto_caracteristicas = ProductoCaracteristica::all();

        return view('front.productos', compact('productos', 'categorias', 'producto_caracteristicas'));
    }

	public function admin()
    {
        return view('front.admin');
    }

    public function factura_design() {
        return view('front.factura_uno');
    }



}
