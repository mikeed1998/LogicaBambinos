<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seccion;
use App\Elemento;
use App\User;
use Auth;
use App\Producto;

class VendedorController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $userId = Auth::user()->id;
        $usuario = User::find($userId);

        return view('vendedor.index', compact('usuario'));
    }

    public function create() {
        $usuarios = User::where('role_as', 0)->get(); // Solo usuarios de tipo cliente / rol = 0
        $productos = Producto::all();

        return view('vendedor.create', compact('usuarios', 'productos'));
    }

    public function store(Request $request) {

    }
}
