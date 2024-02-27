<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Configuracion;

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

    public function mailcontact(Request $request){

		$validate = Validator::make($request->all(),[
			"tipoForm" => "required",
			'nombre' => 'required',
			"empresa" => "required",
			'correo' => 'required',
			"whatsapp" => "required",
			"asunto" => "required",
			'mensaje' => 'nullable',
		],[],[]);

		if ($validate->fails()) {
			\Toastr::error('Error, se requieren todos los datos');
			return redirect()->back();
		}

		$data = array(
			'tipoForm' => $request->tipoForm,
			'nombre' => $request->nombre,
			'empresa' => $request->empresa,
			'correo' => $request->correo,
			'whatsapp' => $request->whatsapp,
			'asunto' => $request->asunto,
			'mensaje' => $request->mensaje,
			'hoy' => Carbon::now()->format('d-m-Y')
		);

		$html = view('front.mailcontact', compact('data'));

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

			$mail->SetFrom($config->remitente, 'PepeFester Contacto');
			$mail->isHTML(true);

			$mail->addAddress($config->destinatario,'PepeFester Contacto');
			if (!empty($config->destinatario2)) {
				$mail->AddBCC($config->destinatario2,'PepeFester Contacto');
			}

			if($data['tipoForm'] == 'contacto') {
				$mail->Subject = $data['asunto'];
			} else {
				$mail->Subject = 'Mensaje';
			}

			$mail->msgHTML($html);
			// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if($mail->send()){
				// dd('paso culo');
			//Contacto@dineroorganico.com
			\Toastr::success('Correo enviado Exitosamente!');
				return redirect()->back();
			}else{
				// dd('no paso culo');
				\Toastr::error('Error al enviar el correo');
				return redirect()->back();
			}


		} catch (phpmailerException $e) {
			\Toastr::error($e->errorMessage());//Pretty error messages from PHPMailer
			return redirect()->back();
		} catch (Exception $e) {
			\Toastr::error($e->getMessage());//Boring error messages from anything else!
			return redirect()->back();
		}
	}

}
