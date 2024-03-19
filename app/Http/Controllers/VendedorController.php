<?php

namespace App\Http\Controllers;

use App\ListaCliente;
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
use App\Pedido;
use Carbon\Carbon;
use App\Producto;
use App\Http\Controllers\CorreosController;
use Illuminate\Support\Facades\Hash;
use App\CarritoPersistente;
use App\Domicilio;

class VendedorController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $userId = Auth::user()->id;
        $usuario = User::find($userId);
        $cotizaciones_lista = ListaCliente::all();
        $pedidos = Pedido::all();

        $lista_cotizaciones = array();
        foreach($pedidos as $ped) {
            if($ped->vendedor && $ped->vendedor == $userId) {
                $lista_cotizaciones[] = $ped;
            }
        }

        return view('vendedor.index', compact('usuario', 'cotizaciones_lista', 'lista_cotizaciones'));
    }

    public function create() {
        $usuarios = User::where('role_as', 0)->get(); // Solo usuarios de tipo cliente / rol = 0
        $productos = Producto::all();

        return view('vendedor.create', compact('usuarios', 'productos'));
    }

    public function store(Request $request) {

    }

    public function storeCliente(Request $request) {
        // dd('usuario');
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

        $us = User::create([
            'name' => $request->nombre_cliente_orden,
            'email' => $request->email_cliente_orden,
            'telefono' => $request->telefono_cliente_orden,
            'password' => Hash::make($contra),
            'role_as' => 0,
        ]);

        Domicilio::create([
            'usuario' => $us->id,
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
        $idVendedor = Auth::id();
        $vendedor = User::find($idVendedor);

        $cliente = User::find($request->usuario_orden);

        $existente_cart = CarritoPersistente::where('usuario', $cliente->id)->first();
        
        if($existente_cart) {
            \Toastr::error('Error: El ususario ya cuenta con una cotización activa.');
            return redirect()->back();
        }

        $cart = new CarritoPersistente;
        $campos_tam = count($request->producto_cliente_orden);

        $carrito = [];
        for ($i = 0; $i < $campos_tam; $i++) {
            $producto_aux = Producto::find($request->producto_cliente_orden[$i]);
            $carrito[$i + 1] = [
                'product_id' => $producto_aux->id,
                'product_name' => $producto_aux->nombre,
                'product_frente' => $producto_aux->frente,
                'product_fondo' => $producto_aux->fondo,
                'product_alto' => $producto_aux->alto,
                'photo' => $producto_aux->portada,
                'price' => $producto_aux->precio,
                'quantity' => $request->cantidad_cotizacion[$i]
            ];
        }

        $carrito_json = json_encode($carrito);

        $cart->usuario = $cliente->id;
        $cart->carrito = $carrito_json;
        $cart->cotizado = 1;

        $pedido_aux = new Pedido;

        $fecha = date('ymd'); // Formato de fecha YYMMDD
        $prefijo = 'PED';
        $ultimoPedidoHoy = Pedido::whereDate('created_at', '=', date('Y-m-d'))->orderBy('created_at', 'desc')->first();

        $secuencia = 1; // Valor por defecto si no hay pedidos ese día
        if ($ultimoPedidoHoy && preg_match('/PED(\d{6})(\d+)/', $ultimoPedidoHoy->uid, $matches)) {
            $secuencia = intval($matches[2]) + 1; // Sumar uno a la última secuencia de hoy
        }

        $uid = sprintf("%s%s%04d", $prefijo, $fecha, $secuencia);

        $domicilio = Domicilio::where('usuario', $request->usuario_orden)->first();
        // dd($domicilio);

        $pedido_aux->domicilio = $domicilio->id;
        $pedido_aux->usuario = $cliente->id;
        $pedido_aux->vendedor = $vendedor->id;
        $pedido_aux->uid = $uid;
        $pedido_aux->estatus = 1;
        $pedido_aux->guia = '';
        $pedido_aux->linkguia = '';
        $pedido_aux->factura = '';
        $pedido_aux->cantidad = 0;
        $pedido_aux->importe = 0;
        $pedido_aux->iva = 0;
        $pedido_aux->total = 0;
        $pedido_aux->envio = 0;
        $pedido_aux->comprobante = '';
        $pedido_aux->cupon = '';
        $pedido_aux->cancelado = 0;
        $pedido_aux->data = $cart->carrito;

        $lista = new ListaCliente;

        $lista->usuario = $cliente->id;
        $lista->vendedor = $vendedor->id;
        
        $pedido_aux->save();
        $cart->save();
        $lista->save();

        $data = array(
			'tipoForm' => 'VendedorCreaCliente',
			'asunto' => 'Nueva Cotización',
			'mensaje' => 'Un asesor asigno productos a tu carrito, ya puedes finalizar tu pago.',
			'hoy' => Carbon::now()->format('d-m-Y')
		);

        $html = view('correos.vendedor_genera_cotizacion', compact('data'));

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

			$mail->SetFrom($config->remitente, 'Brincolines Bambinos - Nueva cotización');
			$mail->isHTML(true);

			$mail->addAddress($cliente->email,'Nueva Cotización');

			$mail->msgHTML($html);

			if($mail->send()){
			    \Toastr::success('El cliente ha sido notificado!');
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

}
