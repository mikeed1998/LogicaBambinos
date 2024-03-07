<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seccion;
use App\Elemento;
use App\Configuracion;
use App\Faq;
use App\Politica;
use App\Producto;

class SeccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $seccion = Seccion::all();

        return view('config.secciones.index',compact('seccion'));
    }

    public function show($seccion) {
        $config = Configuracion::first();

		$seccion = Seccion::where('slug',$seccion)->first();
        $elementos = Elemento::where('seccion',$seccion->id)->get();
        $elem_general = Elemento::all();
        $faqs = Faq::all();
        $politicas = Politica::all();
        $productos = Producto::all();

        if($seccion->seccion == 'configuracion') {
            $ruta = 'config.general.contacto';
        } else if($seccion->seccion == 'politicas') {
            $ruta = 'config.politicas.index';
        } else if($seccion->seccion == 'faqs') {
            $ruta = 'config.faqs.index';
        } else {
            $ruta = 'config.secciones.'.$seccion->seccion;
        }

        return view($ruta, compact('seccion', 'config', 'elem_general', 'faqs', 'politicas', 'productos'));
    }

    public function catalogo_detalle(Producto $producto) {
        return view('config.secciones.catalogo_detalle', compact('producto'));
    }

}



