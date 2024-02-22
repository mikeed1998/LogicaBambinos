<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated()
    {
        if(Auth::user()->role_as == '1')    // Administrador general
        {
            return redirect('admin')->with('status', 'Bienvenido al panel de administrador');
        }
        elseif(Auth::user()->role_as == '2')    // Vendedor
        {
            return redirect('/homeV')->with('status', 'Has iniciado sesión con privilegios de vendedor');
        }
        elseif(Auth::user()->role_as == '0')    // Usuario normal
        {
            return redirect('/home')->with('status', 'Has iniciado sesión');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout()
    {
        Auth::logout(); // Cerrar la sesión del usuario
        Session::forget('cart'); // Limpiar la sesión del carrito
        Session::forget('cartTotal');
        Session::forget('cartTotalUnits');

        return redirect('/login'); // Redirigir a la página de inicio de sesión u otra página según tus necesidades
    }
}
