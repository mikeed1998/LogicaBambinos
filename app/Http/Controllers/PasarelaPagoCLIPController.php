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
use App\CarritoPersistente;
use Carbon\Carbon;
use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Brian2694\Toastr\Facades\Toastr;
use App\Configuracion;
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

        $userId = Auth::id();
        $usuario = User::find($userId);

        $cotizado = CarritoPersistente::where('usuario', $usuario->id)->first();
    
        if($cotizado->cotizado == 1) {
            $pedido_u = Pedido::where('usuario', $usuario->id)->first();
            $vendedor = User::where('id', $pedido_u->vendedor)->first();

            $cartito = json_decode($cotizado->carrito);
            $cantidad = 0;
            foreach($cartito as $coti) {
                $cantidad += $coti->quantity;
            }

            $importe = session()->get('cartTotal');
            $iva = session()->get('cartIVA');
            $total = session()->get('cartTotalGNRL');
            $envio = session()->get('cartEnvio');
        
            $pedido_u->estatus = 2;
            $pedido_u->guia = '';
            $pedido_u->linkguia = '';
            $pedido_u->factura = '';
            $pedido_u->cantidad = $cantidad;
            $pedido_u->importe = $importe;
            $pedido_u->iva = $iva;
            $pedido_u->total = $total;
            $pedido_u->envio = $envio;
            $pedido_u->comprobante = '';
            $pedido_u->cupon = '';
            $pedido_u->cancelado = 0;
            $carrito = session()->get('cart');
            $pedido_u->data = json_encode($carrito);

            $pedido_u->update();

            $pdf_domicilio = Domicilio::where('usuario', $usuario->id)->first();
            $pdf_envio = $pedido_u->envio;
            $pdf_subtotal = $pedido_u->importe;
            $pdf_iva = $pedido_u->iva;
            $pdf_total = $pedido_u->total;
            $pdf_pedido = $pedido_u->uid;

            $pdf_nombre = $usuario->name . ' ' . $usuario->lastname;
            $pdf_numero_cliente = $usuario->id;
            $pdf_telefono = $usuario->telefono;
            $pdf_domicilio_cliente = $pdf_domicilio->calle . ', ext. ' . $pdf_domicilio->numero_exterior . ', int. ' . $pdf_domicilio->numero_interior . ', ' . $pdf_domicilio->alias;
            $pdf_colonia_cliente = $pdf_domicilio->colonia;
            $pdf_codigo_postal_cliente = $pdf_domicilio->codigo_postal;
            $pdf_ciudad_cliente = $pdf_domicilio->municipio;
            $pdf_estado_cliente = $pdf_domicilio->estado;
            $pdf_pais_cliente = $pdf_domicilio->pais;
            $pdf_rfc_cliente = $usuario->RFC;
            $pdf_correo_cliente = $usuario->email;
            $pdf_paqueteria = 'FEDEX';
            $pdf_tipo_envio = 'NACIONAL';
            $pdf_asesor = $vendedor->name . ' ' . $vendedor->lastname;

            $pdf_productose = json_encode($carrito);

            $pdf_fecha = $pedido_u->created_at->format('d-m-Y');

            $factura = new Dompdf();

            $lista_compras = view('facturas.factura_uno', compact('pdf_pedido', 'pdf_fecha', 'pdf_nombre', 'pdf_numero_cliente', 'pdf_telefono', 'pdf_domicilio_cliente', 'pdf_colonia_cliente', 'pdf_codigo_postal_cliente', 'pdf_ciudad_cliente', 'pdf_estado_cliente', 'pdf_pais_cliente', 'pdf_rfc_cliente', 'pdf_correo_cliente', 'pdf_paqueteria', 'pdf_tipo_envio', 'pdf_asesor', 'pdf_productose', 'pdf_envio', 'pdf_subtotal', 'pdf_iva', 'pdf_total'));
            $htmlTotal = $lista_compras . '<div style="page-break-after: always;"></div>';
            
            $pdf_productosd = json_decode($pdf_productose);
            // dd($pdf_productosd);
            foreach($pdf_productosd as $product) {
                $rutaImagen = 'img/productos/'.$product->photo;
        
                if(file_exists($rutaImagen)) {
                    $imagen_data = file_get_contents($rutaImagen);
                    $imagenBase64 = base64_encode($imagen_data);
                }

                $compra = view('facturas.factura_dos', compact('pdf_pedido', 'product', 'pdf_fecha', 'pdf_nombre', 'pdf_numero_cliente', 'pdf_asesor', 'imagenBase64'));
                // Agrega un salto de linea entre cada pagina almacenada en compra
                $htmlTotal .= $compra . '<div style="page-break-after: always;"></div>';
            }

            $poliza = view('facturas.factura_tres', compact('pdf_pedido', 'pdf_fecha', 'pdf_nombre', 'pdf_numero_cliente'));
            $htmlTotal .= $poliza . '<div style="page-break-after: always;"></div>';

            $cupones = view('facturas.factura_cuatro', compact('pdf_pedido', 'pdf_fecha'));
            $htmlTotal .= $cupones . '<div style="page-break-after: always;"></div>';

            $factura->loadHtml($htmlTotal);
            $factura->render();
            // $nombre_orden = 'Orden_' . $pdf_pedido . '_brincolines_bambinos.pdf';
            // $factura->stream($nombre_orden);

            // Definimos el nombre del archivo
            $nombreArchivo = 'Orden_' . $pdf_pedido . '_brincolines_bambinos.pdf';

            // Obtenemos el contenido del PDF generado
            $pdfContent = $factura->output();

            // Definimos la ruta completa donde queremos guardar el archivo, incluyendo el nombre del archivo
            $rutaArchivo = public_path('img/ordenes/' . $nombreArchivo);

            // Utilizamos file_put_contents para guardar el contenido en el archivo especificado
            file_put_contents($rutaArchivo, $pdfContent);

            $data = array(
                'tipoForm' => 'VendedorCreaCliente',
                'nombre' => $pdf_nombre,
                'telefono' => $pdf_telefono,
                'correo' => $pdf_correo_cliente,
                'asunto' => 'Tu compra ha sido exitosa',
                'mensaje' => 'Tu pago en Brincolines Bambinos ha sido procesado, gracias por usar nuestro servicio.',
                'hoy' => Carbon::now()->format('d-m-Y')
            );
    
            $html = view('correos.enviar_factura', compact('data'));
    
            $config = Configuracion::first();
    
            $mail = new PHPMailer;
    
            $mail->isSMTP();
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            //$mail->SMTPDebug = 2;
            $mail->Host = $config->remitentehost;
            $mail->SMTPAuth = true;
            $mail->Username = $config->remitente;
            $mail->Password = $config->remitentepass;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $config->remitenteport;
    
            $mail->SetFrom($config->remitente, 'Brincolines Bambinos - Confirmación de compra');
            $mail->isHTML(true);
    
            $mail->addAddress($pdf_correo_cliente,'Compra exitosa');
    
            $mail->addAttachment($rutaArchivo, $nombreArchivo);

            $mail->msgHTML($html);
    
            $mail->send();
            
            // dd($pdf_fecha, $pdf_productose, $pdf_envio, $pdf_subtotal, $pdf_iva, $pdf_total, $pdf_pedido, $pdf_nombre, $pdf_numero_cliente, $pdf_telefono, $pdf_domicilio_cliente, $pdf_colonia_cliente, $pdf_codigo_postal_cliente, $pdf_ciudad_cliente, $pdf_estado_cliente, $pdf_pais_cliente, $pdf_rfc_cliente, $pdf_correo_cliente, $pdf_paqueteria, $pdf_tipo_envio, $pdf_asesor);
            
             // Limpiar sesion de carrito y el carrito persistente
             $cotizado->delete();
             session()->put('cart', []);
             session()->put('cartTotal', 0);
             session()->put('cartIVA', 0);
             session()->put('cartTotalGNRL', 0);

            return view('pagos.CLIP.success');
        } else {

            $pedido = new Pedido;

            $domicilio = Domicilio::where('usuario', $usuario->id)->first();
            // $cantidad = session()->get('cartTotalUnits');
            $importe = session()->get('cartTotal');
            $iva = session()->get('cartIVA');
            $total = session()->get('cartTotalGNRL');
            $envio = session()->get('cartEnvio');

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

            $cartito = json_decode($cotizado->carrito);
            $cantidad = 0;
            foreach($cartito as $coti) {
                $cantidad += $coti->quantity;
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
            


            $pdf_domicilio = Domicilio::where('usuario', $usuario->id)->first();
            $pdf_envio = $pedido->envio;
            $pdf_subtotal = $pedido->importe;
            $pdf_iva = $pedido->iva;
            $pdf_total = $pedido->total;
            $pdf_pedido = $pedido->uid;

            $pdf_nombre = $usuario->name . ' ' . $usuario->lastname;
            $pdf_numero_cliente = $usuario->id;
            $pdf_telefono = $usuario->telefono;
            $pdf_domicilio_cliente = $pdf_domicilio->calle . ', ext. ' . $pdf_domicilio->numero_exterior . ', int. ' . $pdf_domicilio->numero_interior . ', ' . $pdf_domicilio->alias;
            $pdf_colonia_cliente = $pdf_domicilio->colonia;
            $pdf_codigo_postal_cliente = $pdf_domicilio->codigo_postal;
            $pdf_ciudad_cliente = $pdf_domicilio->municipio;
            $pdf_estado_cliente = $pdf_domicilio->estado;
            $pdf_pais_cliente = $pdf_domicilio->pais;
            $pdf_rfc_cliente = $usuario->RFC;
            $pdf_correo_cliente = $usuario->email;
            $pdf_paqueteria = 'FEDEX';
            $pdf_tipo_envio = 'NACIONAL';
            $pdf_asesor = 'NINGUNO';

            $pdf_productose = json_encode($carrito);

            $pdf_fecha = $pedido->created_at->format('d-m-Y');

            $factura = new Dompdf();

            $lista_compras = view('facturas.factura_uno', compact('pdf_pedido', 'pdf_fecha', 'pdf_nombre', 'pdf_numero_cliente', 'pdf_telefono', 'pdf_domicilio_cliente', 'pdf_colonia_cliente', 'pdf_codigo_postal_cliente', 'pdf_ciudad_cliente', 'pdf_estado_cliente', 'pdf_pais_cliente', 'pdf_rfc_cliente', 'pdf_correo_cliente', 'pdf_paqueteria', 'pdf_tipo_envio', 'pdf_asesor', 'pdf_productose', 'pdf_envio', 'pdf_subtotal', 'pdf_iva', 'pdf_total'));
            $htmlTotal = $lista_compras . '<div style="page-break-after: always;"></div>';
            
            $pdf_productosd = json_decode($pdf_productose);
            // dd($pdf_productosd);
            foreach($pdf_productosd as $product) {
                $rutaImagen = 'img/productos/'.$product->photo;
        
                if(file_exists($rutaImagen)) {
                    $imagen_data = file_get_contents($rutaImagen);
                    $imagenBase64 = base64_encode($imagen_data);
                }

                $compra = view('facturas.factura_dos', compact('pdf_pedido', 'product', 'pdf_fecha', 'pdf_nombre', 'pdf_numero_cliente', 'pdf_asesor', 'imagenBase64'));
                // Agrega un salto de linea entre cada pagina almacenada en compra
                $htmlTotal .= $compra . '<div style="page-break-after: always;"></div>';
            }

            $poliza = view('facturas.factura_tres', compact('pdf_pedido', 'pdf_fecha', 'pdf_nombre', 'pdf_numero_cliente'));
            $htmlTotal .= $poliza . '<div style="page-break-after: always;"></div>';

            $cupones = view('facturas.factura_cuatro', compact('pdf_pedido', 'pdf_fecha'));
            $htmlTotal .= $cupones . '<div style="page-break-after: always;"></div>';

            $factura->loadHtml($htmlTotal);
            $factura->render();
            // $nombre_orden = 'Orden_' . $pdf_pedido . '_brincolines_bambinos.pdf';
            // $factura->stream($nombre_orden);

            // Definimos el nombre del archivo
            $nombreArchivo = 'Orden_' . $pdf_pedido . '_brincolines_bambinos.pdf';

            // Obtenemos el contenido del PDF generado
            $pdfContent = $factura->output();

            // Definimos la ruta completa donde queremos guardar el archivo, incluyendo el nombre del archivo
            $rutaArchivo = public_path('img/ordenes/' . $nombreArchivo);

            // Utilizamos file_put_contents para guardar el contenido en el archivo especificado
            file_put_contents($rutaArchivo, $pdfContent);

            $data = array(
                'tipoForm' => 'VendedorCreaCliente',
                'nombre' => $pdf_nombre,
                'telefono' => $pdf_telefono,
                'correo' => $pdf_correo_cliente,
                'asunto' => 'Tu compra ha sido exitosa',
                'mensaje' => 'Tu pago en Brincolines Bambinos ha sido procesado, gracias por usar nuestro servicio.',
                'hoy' => Carbon::now()->format('d-m-Y')
            );
    
            $html = view('correos.enviar_factura', compact('data'));
    
            $config = Configuracion::first();
    
            $mail = new PHPMailer;
    
            $mail->isSMTP();
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            //$mail->SMTPDebug = 2;
            $mail->Host = $config->remitentehost;
            $mail->SMTPAuth = true;
            $mail->Username = $config->remitente;
            $mail->Password = $config->remitentepass;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $config->remitenteport;
    
            $mail->SetFrom($config->remitente, 'Brincolines Bambinos - Confirmación de compra');
            $mail->isHTML(true);
    
            $mail->addAddress($pdf_correo_cliente,'Compra exitosa');
    
            $mail->addAttachment($rutaArchivo, $nombreArchivo);

            $mail->msgHTML($html);
    
            $mail->send();

            // Limpiar sesion de carrito y el carrito persistente
            $cotizado->delete();
            session()->put('cart', []);
            session()->put('cartTotal', 0);
            session()->put('cartIVA', 0);
            session()->put('cartTotalGNRL', 0);
            
            // dd($pdf_fecha, $pdf_productose, $pdf_envio, $pdf_subtotal, $pdf_iva, $pdf_total, $pdf_pedido, $pdf_nombre, $pdf_numero_cliente, $pdf_telefono, $pdf_domicilio_cliente, $pdf_colonia_cliente, $pdf_codigo_postal_cliente, $pdf_ciudad_cliente, $pdf_estado_cliente, $pdf_pais_cliente, $pdf_rfc_cliente, $pdf_correo_cliente, $pdf_paqueteria, $pdf_tipo_envio, $pdf_asesor);
            // dd("ver si se duplica");

            

            return view('pagos.CLIP.success');
            
        }

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

