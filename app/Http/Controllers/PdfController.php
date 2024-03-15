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
        $subtotal = 347.50;
        $iva = $subtotal * 0.16;
        $total = $subtotal + $iva;

        $nombre = $usuario->name . ' ' . $usuario->lastname;
        $numero_cliente = $usuario->id;
        $telefono = $usuario->telefono;
        $domicilio_cliente = $domicilio->calle . ', ext. ' . $domicilio->numero_exterior . ', int. ' . $domicilio->numero_interior . ', ' . $domicilio->alias;
        $colonia_cliente = $domicilio->colonia;
        $codigo_postal_cliente = $domicilio->codigo_postal;
        $ciudad_cliente = $domicilio->ciudad;
        $estado_cliente = $domicilio->estado;
        $pais_cliente = $domicilio->pais;
        $rfc_cliente = $usuario->RFC;
        $correo_cliente = $usuario->email;
        $paqueteria = 'FEDEX';
        $tipo_envio = 'NACIONAL';
        $asesor = 'Martin Burger King';

        $productos = array(
            "1" => array(
                "nombre" => "Juan",
                "cantidad" => 1,
                "precio" => 250.50,
                "photo" => ""
            ),
            "2" => array(
                "nombre" => "María",
                "cantidad" => 2,
                "precio" => 310.50,
                "photo" => ""
            )
        );

        dd($domicilio_cliente);

        $lista_compras = view('facturas.factura_uno');
        // $compra = view('facturas.factura_dos');
        // $poliza = view('facturas.factura_tres');
        // $promocion = view('facturas.factura_cuatro');

        // Crea una instancia de Dompdf
        $dompdf = new Dompdf();

        // GENERAR MAS INSTRANCIAS DE DOMPDF DENTRO DE UN CICLO POR PRODUCTO Y UNA ULTIMA INSTANCIA PARA LAS HOJAS FINALES

        // Carga la vista Blade en Dompdf
        $dompdf->loadHtml($view->render());

        // Renderiza el PDF
        $dompdf->render();

        // Descarga el PDF
        $dompdf->stream('factura_uno.pdf');
    }
}
