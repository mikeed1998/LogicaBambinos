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
        $cliente = new Client();

        // "amount": '.$totalCompra.',

        $response = $cliente->request('POST', 'https://api-gw.payclip.com/checkout', [
            'body' => '
            {
                "amount": 1.50,
                "currency":"MXN",
                "purchase_description":"ejemplo de compra laravel",
                "redirection_url":
                {
                    "success":"/",
                    "error":"/home",
                    "default":"/"
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

        return view('pagos.CLIP.index', compact('paymentRequestId', 'totalCompra'));
    }
}
