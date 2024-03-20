<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Auth;
use App\User;
use Carbon\Carbon;
use App\Domicilio;

class PdfController extends Controller
{
    public function generatePdf() {
        $userId = Auth::id();
        $usuario = User::find($userId);
        $fechaActual = Carbon::now();
        $fechaActualFormateada = $fechaActual->format('d-m-Y');
        $subtotal = 347.50;
        $iva = $subtotal * 0.16;
        $total = $subtotal + $iva;

        // dd($total);

        // Obtiene la vista Blade que contiene el contenido del PDF
        $view = view('facturas.index', compact('usuario', 'fechaActualFormateada', 'subtotal', 'iva', 'total'));

        // Crea una instancia de Dompdf
        $dompdf = new Dompdf();

        // Carga la vista Blade en Dompdf
        $dompdf->loadHtml($view->render());

        // Renderiza el PDF
        $dompdf->render();

        // Descarga el PDF
        $dompdf->stream('mi-pdf.pdf');
    }

    public function generatePdf_factura() {

        $userId = Auth::id();
        $usuario = User::find($userId);
        $fechaActual = Carbon::now();
        $domicilio = Domicilio::where('usuario', $usuario->id)->first();
        $fechaActualFormateada = $fechaActual->format('d-m-Y');
        $envio = 100.00;
        $subtotal = 310.50 + 250.50;
        $iva = $subtotal * 0.16;
        $total = $subtotal + $iva + $envio;
        $pedido = 'PED2403110001';

        $nombre = $usuario->name . ' ' . $usuario->lastname;
        $numero_cliente = $usuario->id;
        $telefono = $usuario->telefono;
        $domicilio_cliente = $domicilio->calle . ', ext. ' . $domicilio->numero_exterior . ', int. ' . $domicilio->numero_interior . ', ' . $domicilio->alias;
        $colonia_cliente = $domicilio->colonia;
        $codigo_postal_cliente = $domicilio->codigo_postal;
        $ciudad_cliente = $domicilio->municipio;
        $estado_cliente = $domicilio->estado;
        $pais_cliente = $domicilio->pais;
        $rfc_cliente = $usuario->RFC;
        $correo_cliente = $usuario->email;
        $paqueteria = 'FEDEX';
        $tipo_envio = 'NACIONAL';
        $asesor = 'Martin Burger King';

        $productos = array(
            "1" => array(
                "product_name" => "Brincolin divertido",
                "quantity" => 1,
                "price" => 250.50,
                "photo" => "20231229160623.png",
                "product_frente" => "10M",
                'product_fondo' => "20M",
                'product_alto' => "30M"
            ),
            "2" => array(
                "product_name" => "Castillo acuatico",
                "quantity" => 2,
                "price" => 310.50,
                "photo" => "20231229160623.png",
                "product_frente" => "10M",
                'product_fondo' => "20M",
                'product_alto' => "30M"
            )
        );

        $cart_productos = json_encode($productos);
        
        $factura = new Dompdf();

        $lista_compras = view('facturas.factura_uno', compact('pedido', 'fechaActualFormateada', 'nombre', 'numero_cliente', 'telefono', 'domicilio_cliente', 'colonia_cliente', 'codigo_postal_cliente', 'ciudad_cliente', 'estado_cliente', 'pais_cliente', 'rfc_cliente', 'correo_cliente', 'paqueteria', 'tipo_envio', 'asesor', 'cart_productos', 'envio', 'subtotal', 'iva', 'total'));
        $htmlTotal = $lista_compras . '<div style="page-break-after: always;"></div>';
      
        foreach($productos as $product) {
            $rutaImagen = 'img/productos/'.$product['photo'];
    
            if(file_exists($rutaImagen)) {
                $imagen_data = file_get_contents($rutaImagen);
                $imagenBase64 = base64_encode($imagen_data);
            }

            $compra = view('facturas.factura_dos', compact('pedido', 'product', 'fechaActualFormateada', 'nombre', 'numero_cliente', 'asesor', 'imagenBase64'));
            // Agrega un salto de linea entre cada pagina almacenada en compra
            $htmlTotal .= $compra . '<div style="page-break-after: always;"></div>';
        }

        $poliza = view('facturas.factura_tres', compact('pedido', 'fechaActualFormateada', 'nombre', 'numero_cliente'));
        $htmlTotal .= $poliza . '<div style="page-break-after: always;"></div>';

        $cupones = view('facturas.factura_cuatro', compact('pedido', 'fechaActualFormateada'));
        $htmlTotal .= $cupones . '<div style="page-break-after: always;"></div>';

        $factura->loadHtml($htmlTotal);
        $factura->render();
        $factura->stream('factura.pdf');
    }
}



