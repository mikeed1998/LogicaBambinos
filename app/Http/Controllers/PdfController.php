<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Auth;
use App\User;
use Carbon\Carbon;

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
        $view = view('front.factura_uno');

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
