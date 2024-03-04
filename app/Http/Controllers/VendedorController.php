<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Seccion;
use App\Elemento;
use App\Configuracion;
use App\User;
use Auth;
use Carbon\Carbon;
use App\Producto;
use App\Http\Controllers\CorreosController;
use Illuminate\Support\Facades\Hash;

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

    public function storeCliente(Request $request) {
        // dd($request);
        $usuarios = User::all();
        $contra = '';

        if($request->password_cliente_orden == null) {
            $contra = $request->telefono_cliente_orden;
        } else {
            $contra = $request->password_cliente_orden;
        }

        foreach($usuarios as $user) {
            if($request->email_cliente_orden == $user->email) {
                \Toastr::error('El usuario ya existe');
                return redirect()->back();
            }
        }

        User::create([
            'name' => $request->nombre_cliente_orden,
            'email' => $request->email_cliente_orden,
            'telefono' => $request->telefono_cliente_orden,
            'password' => Hash::make($contra),
            'role_as' => 0,
        ]);

        $data = array(
			'tipoForm' => 'VendedorCreaCliente',
			'nombre' => $request->nombre_cliente_orden,
			'correo' => $request->email_cliente_orden,
			'telefono' => $request->telefono_cliente_orden,
            'password' => $contra,
			'asunto' => 'Asunto',
			'mensaje' => 'Ahora podrás ser asignado a mas cotizacines o tu mismo comprar desde nuestra tienda',
			'hoy' => Carbon::now()->format('d-m-Y')
		);

        $html = view('correos.vendedor_genera_cliente', compact('data'));

        $config = Configuracion::first();

		$mail = new PHPMailer;

		try {
			$mail->isSMTP();
			// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
			// $mail->SMTPDebug = 2;
			$mail->Host = $config->remitentehost;
			$mail->SMTPAuth = true;
			$mail->Username = $config->remitente;
			$mail->Password = $config->remitentepass;
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			$mail->Port = $config->remitenteport;

			$mail->SetFrom($config->remitente, 'Brincolines Bambinos - Cuenta nueva');
			$mail->isHTML(true);

			$mail->addAddress($request->email_cliente_orden,'Nueva Cuenta');

			$mail->msgHTML($html);

			if($mail->send()){
			    \Toastr::success('Correo enviado al nuevo cliente!');
				return redirect()->back();
			}else{
				\Toastr::error('Error al enviar el correo');
				return redirect()->back();
			}

		} catch (phpmailerException $e) {
			\Toastr::error($e->errorMessage());
			return redirect()->back();
		} catch (Exception $e) {
			\Toastr::error($e->getMessage());
			return redirect()->back();
		}
    }

    public function storeCotizacion(Request $request) {

    }

}
