<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PasarelaPagoCLIPController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart');
        $totalCompra = session()->get('cartTotal');
        $cantidad_productos = session()->get('cartTotalUnits');
        $iva = session()->get('cartIVA');
        $totalGRNL = session()->get('cartTotalGNRL');
        $envio = session()->get('cartEnvio');
        $cliente = new Client();

        // "amount": '.$totalCompra.',

        $response = $cliente->request('POST', 'https://api-gw.payclip.com/checkout', [
            'body' => '
            {
                "amount": 1.0,
                "currency":"MXN",
                "purchase_description":"ejemplo de compra laravel",
                "redirection_url":
                {
                    "success":"'.url('clip_success').'",
                    "error":"'.url('clip_error').'",
                    "default":"/home"
                },
                "expires_at":"",
                "metadata":{
                    "me_reference_id": "OID123456789",
                    "customer_info":
                    {
                        "name": "Michael Eduardo",
                        "email": "mikeed1998@gmail.com",
                        "phone": "3322932239"
                    },
                    "billing_address":
                    {
                        "zip_code": "03800A",
                        "locality": "Villas de San Juan",
                        "city": "Guadalajara",
                        "State": "Jalisco",
                        "country": "Mexico",
                        "street": "Av. Normalistas",
                        "outdoor_number": "C9",
                        "interior_number": "9",
                        "reference": "Manzana I",
                        "between_streets": "Av. Noramlistas y Monte Olivete",
                        "floor": "4"
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

        return view('pagos.CLIP.index', compact('paymentRequestId', 'totalCompra', 'cantidad_productos', 'iva', 'totalGRNL', 'envio'));
    }

    public function clip_success() {
        // Logic to handle successful payment (optional)
        $tipo = 'success';
        $titulo = '¡Pago exitoso!';
        $mensaje = 'Tu pago se ha realizado con éxito.';
        $rutaRedireccion = '/home';

        return view('pagos.CLIP.success', compact('tipo', 'titulo', 'mensaje', 'rutaRedireccion'));
    }

    public function clip_error() {
         // Logic to handle payment error (optional)
        $tipo = 'error';
        $titulo = '¡Error en el pago!';
        $mensaje = 'Ocurrió un error al procesar tu pago. Intenta nuevamente.';
        $rutaRedireccion = '/cart';

        return view('pagos.CLIP.error', compact('tipo', 'titulo', 'mensaje', 'rutaRedireccion'));
    }

}
