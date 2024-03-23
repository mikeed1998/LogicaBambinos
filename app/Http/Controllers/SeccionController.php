<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seccion;
use App\Elemento;
use App\Configuracion;
use App\Faq;
use App\Politica;
use App\Producto;
use App\User;
use App\Pedido;
use App\ListaCliente;
use Illuminate\Support\Facades\DB;

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
        $usuarios = User::all();
        $pedidos = Pedido::all();
        $vendedores = User::where('role_as', 2)->get()->toBase();
        $clientes = User::where('role_as', 0)->get()->toBase();
        $clientesPorVendedor = ListaCliente::select('vendedor', DB::raw('COUNT(*) as conteo'))
            ->groupBy('vendedor')
            ->orderByDesc('conteo')
            ->take(5)
            ->get()
            ->toArray();

        $pedidosPorMes = Pedido::select(DB::raw('MONTH(created_at) as mes'), DB::raw('COUNT(*) as total_por_mes'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        if($seccion->seccion == 'configuracion') {
            $ruta = 'config.general.contacto';
        } else if($seccion->seccion == 'politicas') {
            $ruta = 'config.politicas.index';
        } else if($seccion->seccion == 'faqs') {
            $ruta = 'config.faqs.index';
        } else {
            $ruta = 'config.secciones.'.$seccion->seccion;
        }

        return view($ruta, compact('seccion', 'config', 'elem_general', 'faqs', 'politicas', 'productos', 'usuarios', 'clientes', 'vendedores', 'pedidos', 'clientesPorVendedor', 'pedidosPorMes'));
    }

}



