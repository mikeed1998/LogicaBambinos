<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seccion;
use App\Elemento;
use App\User;
use Auth;
use Carbon\Carbon;

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

        return view('user.index', compact('usuario', 'fechaActual'));
    }
}
