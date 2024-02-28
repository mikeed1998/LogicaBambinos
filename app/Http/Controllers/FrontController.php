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

	public function admin()
    {
        return view('front.admin');
    }



}
