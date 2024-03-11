<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Categoria;
use App\Subcategoria;
use App\Producto;
use App\ProductoCaracteristica;
use App\ProductoGaleria;
use Auth;
use App\User;
use App\Domicilio;
use App\DatosEnvio;
use App\Pedido;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class PasarelaPagoCLIPController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $usuario = User::find($userId);
        $domicilio = Domicilio::where('usuario', $usuario->id)->first();
        $nombres = $usuario->name;
        $apellidos = $usuario->lastname;

        $name = $nombres . " " . $apellidos;
        $email = $usuario->email;
        $phone = $usuario->telefono;
        $zip_code = $domicilio->codigo_postal;
        $locality = $domicilio->colonia;
        $city = $domicilio->ciudad;
        $state = $domicilio->estado;
        $country = $domicilio->pais;
        $street = $domicilio->calle;
        $outdoor_number = $domicilio->numero_exterior;
        $interior_number = $domicilio->numero_interior;
        $reference = $domicilio->alias;

        // session()->put('ordenCompra', '');
        $cart = session()->get('cart');
        $totalCompra = session()->get('cartTotal');
        $cantidad_productos = session()->get('cartTotalUnits');
        $iva = session()->get('cartIVA');
        $totalGRNL = session()->get('cartTotalGNRL');
        $envio = session()->get('cartEnvio');
        $cliente = new Client();
        $random = Carbon::now()->format('d-m-Y H:i:s');
        $reference_id = "REF_" . $random;

        // "amount": '.$totalCompra.',

        $response = $cliente->request('POST', 'https://api-gw.payclip.com/checkout', [
            'body' => '
            {
                "amount": 1.0,
                "currency":"MXN",
                "purchase_description":"Brincolines Bambinos",
                "redirection_url":
                {
                    "success":"'.url('clip_success').'",
                    "error":"'.url('clip_error').'",
                    "default":"/home"
                },
                "expires_at":"",
                "metadata":{
                    "me_reference_id":"'.$reference_id.'",
                    "customer_info":
                    {
                        "name": "'.$name.'",
                        "email": "'.$email.'",
                        "phone": "'.$phone.'"
                    },
                    "billing_address":
                    {
                        "zip_code": "'.$zip_code.'",
                        "locality": "'.$locality.'",
                        "city": "'.$city.'",
                        "State": "'.$state.'",
                        "country": "'.$country.'",
                        "street": "'.$street.'",
                        "outdoor_number": "'.$outdoor_number.'",
                        "interior_number": "'.$interior_number.'",
                        "reference": "'.$reference.'",
                        "between_streets": "",
                        "floor": "0"
                    }
                },
                "webhook_url": "https://webhook.site/2c408bb6-7792-4833-8294-66fe59b091b6"
            }',
            'headers' => [
                'accept' => 'application/vnd.com.payclip.v2+json',
                'content-type' => 'application/json',
                'x-api-key' => 'Basic YzA4NjNkZDMtNTVlOC00MzRlLWEzOWEtYTkxM2E4MTc4NDRhOjViMDk3ZmI4LTVhMTYtNDRjMS1hZGYyLWVlNjhlYjlhYmZlYQ==',
            ],
        ]);

        $responseBody = $response->getBody();
        $responseData = json_decode($responseBody, true);
        $paymentRequestId = $responseData['payment_request_id'];

        // dd($cart, $T);
        // session()->put('ordenCompra', $paymentRequestId);

        return view('pagos.CLIP.index', compact('paymentRequestId', 'totalCompra', 'cantidad_productos', 'iva', 'totalGRNL', 'envio'));
    }


    public function clip_success() {
        /*  En esta función el pago ya fue depositado a la cuenta de CLIP
            0 = CANCELADO 	-----> Cliente y Vendedor (no se puede revertir)
            1 = ASIGNADO	-----> Vendedor (El cliente y vendedor lo pueden cancelar)
            2 = PAGADO   	-----> Cliente (Pagar sin necesidad de un vendedor y en caso de estar ASIGNADO)
            3 = ENVIADO	    -----> Vendedor (Una vez que haya comprobado que se pago)
        */// Los pedidos cancelados no se borrarán, solo se archivarán

// ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓
//                              CASOS
// ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓
/*
█ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █
    Si el vendedor ya le asigno una cotización, recuperar el pedido pendiente
█ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █
*/



/*
█ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █
*/



/*
█ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █
    Si el cliente hizo la compra sin ayuda de un asesor, crear el pedido desde cero
█ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █
*/
        // Crear pedido
        $pedido = new Pedido;

        $userId = Auth::id();
        $usuario = User::find($userId);
        $domicilio = Domicilio::where('usuario', $usuario->id)->first();
        $cantidad = session()->get('cartTotalUnits');
        $importe = session()->get('cartTotal');
        $iva = session()->get('cartIVA');
        $total = session()->get('cartTotalGNRL');
        $envio = session()->get('cartEnvio');
        $vendedor = session()->get('asesor');

        // Generar un identificador único para el pedido = UID
        $fecha = date('ymd'); // Formato de fecha YYMMDD
        $prefijo = 'PED';
        $ultimoPedidoHoy = Pedido::whereDate('created_at', '=', date('Y-m-d'))->orderBy('created_at', 'desc')->first();

        $secuencia = 1; // Valor por defecto si no hay pedidos ese día
        if ($ultimoPedidoHoy && preg_match('/PED(\d{6})(\d+)/', $ultimoPedidoHoy->uid, $matches)) {
            $secuencia = intval($matches[2]) + 1; // Sumar uno a la última secuencia de hoy
        }

        $uid = sprintf("%s%s%04d", $prefijo, $fecha, $secuencia);

        $pedido->domicilio = $domicilio->id;
        $pedido->usuario = $usuario->id;
        if($vendedor != null){
            $pedido->vendedor = session()->get('asesor');
        } else {
            $pedido->vendedor = null;
        }

        $pedido->uid = $uid;
        $pedido->estatus = 2;
        $pedido->guia = '';
        $pedido->linkguia = '';
        $pedido->factura = '';
        $pedido->cantidad = $cantidad;
        $pedido->importe = $importe;
        $pedido->iva = $iva;
        $pedido->total = $total;
        $pedido->envio = $envio;
        $pedido->comprobante = '';
        $pedido->cupon = '';
        $pedido->cancelado = 0;
        $carrito = session()->get('cart');
        $pedido->data = json_encode($carrito);

        $pedido->save();

        return view('pagos.CLIP.success');
/*
█ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █
*/
    }

    // NO APLICA PARA LA PASARELA DE CLIP
    public function clip_error() {
         // Lógica opcional, CLIP por defecto solo te pide volver a intentar el pago en lugar de utilizar una vista de error
        $tipo = 'error';
        $titulo = '¡Error en el pago!';
        $mensaje = 'Ocurrió un error al procesar tu pago. Intenta nuevamente.';
        $rutaRedireccion = '/cart';

        return view('pagos.CLIP.error', compact('tipo', 'titulo', 'mensaje', 'rutaRedireccion'));
    }

}

