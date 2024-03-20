<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seccion;
use App\Elemento;
use App\User;
use Auth;
use Carbon\Carbon;
use App\Domicilio;
use App\Pedido;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::user()->id;
        $usuario = User::find($userId);
        $fechaActual = Carbon::now()->toDateString();
        $domicilio = Domicilio::where('usuario', $userId)->first();
        $vendedores = User::where('role_as', 2)->get()->toBase();
        $pedidos = Pedido::where('usuario', $usuario->id)->get()->toBase();

        return view('user.index', compact('usuario', 'fechaActual', 'domicilio', 'pedidos', 'vendedores'));
    }
}
