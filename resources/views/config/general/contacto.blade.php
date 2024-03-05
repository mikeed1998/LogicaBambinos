@extends('layouts.admin')
<style>
	/* mas estilisado */
	body{
		background-color: #e5e8eb  !important;
	}
	.card-header {
		background-color: #b0c1d1  !important;
	}
	.black-skin .btn-primary {
		background-color: #b0c1d1  !important;
	}
	.btn {
		box-shadow: none;
		border-radius: 15px;
	}
/* mas estilisado */
</style>
@section('content')
	<div class="row mt-5 py-5  px-2">
		<a href="{{ route('admin.index') }}" class="col col-md-2 btn btn-sm btn-dark mr-auto"><i class="fa fa-reply"></i> Regresar</a>
	</div>
	<div class="row justify-content-center p-4">
		<div class="col-12 col-md-4 p-2">
			<div class=" h-100 card" style="border-radius: 16px; box-shadow: none;">
				<div class="card-body">
					<h5 class="card-title text-center">Teléfonos</h5>
					<div class="form-group">
						<label for="telefono"> Teléfono fijo</label>
						<input type="text" class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="telefono" name="telefono" data-table="configuracions" data-campo="telefono" data-id="{{$config->id}}"  value="{{ $config->telefono }}">
                    </div>
					<div class="form-group">
						<label for="whatsapp"> Whatsapp </label>
						<input type="text" class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="whatsapp" name="whatsapp" data-table="configuracion" data-campo="whatsapp" data-id="{{$config->id}}"  value="{{ $config->whatsapp }}">
					</div>
					{{-- <div class="form-group">
						<label for="whatsapp2"> Whatsapp 2</label>
						<input type="text" class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="whatsapp2" name="whatsapp2" data-id="{{$config->id}}" data-table="configuracion" data-campo="whatsapp2"  value="{{ $config->whatsapp2 }}">
					</div> --}}
				</div>
			</div>
		</div>
		<div class="col-12 col-md-4 p-2">
			<div class=" h-100 card" style="border-radius: 16px; box-shadow: none;">
				<div class="card-body">
					<h5 class="card-title text-center">Redes sociales</h5>
					<div class="form-group">
						<label for="fb"> Facebook</label>
						<input type="text" class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="fb" name="fb" data-id="{{$config->id}}" data-table="configuracion" data-campo="facebook"  value="{{ $config->facebook }}">
					</div>
					<div class="form-group">
						<label for="ig"> Instagram</label>
						<input type="text" class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="ig" name="ig" data-id="{{$config->id}}" data-table="configuracion" data-campo="instagram"  value="{{ $config->instagram }}">
					</div>
					<div class="form-group">
						<label for="yt"> YouTube </label>
						<input type="text" class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="yt" name="yt" data-id="{{$config->id}}" data-table="configuracion" data-campo="youtube"  value="{{ $config->youtube }}">
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-4 p-2">
			<div class=" h-100 card" style="border-radius: 16px; box-shadow: none;">
				<div class="card-body">
					<h5 class="card-title text-center">Envío de correo</h5>
					<div class="form-group">
						<label for="destinatario">  Destinatario 1 </label>
						<input type="text" class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="destinatario" name="destinatario" data-id="{{$config->id}}" data-table="configuracion" data-campo="destinatario"  value="{{ $config->destinatario }}">
					</div>
					<div class="form-group">
						<label for="destinatario2">  Destinatario 2 </label>
						<input type="text" class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="destinatario2" name="destinatario2" data-id="{{$config->id}}" data-table="configuracion" data-campo="destinatario2"  value="{{ $config->destinatario2 }}">
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-4 p-2">
			<div class="card" style="border-radius: 16px; box-shadow: none;">
				<div class="card-body">
					<h5 class="card-title text-center">Mapa</h5>
					<div class="form-group">
						<label for="mapa">  URL de Mapa </label>
						<input type="text" class="form-control editar_text_seccion_global editarajax" id="mapa" name="mapa" data-url="{{route('textglobalseccion')}}" data-id="{{$config->id}}" data-table="configuracion" data-campo="mapa"  value="{{ $config->mapa }}">
					</div>
					<div class="form-group">
						<label for="direccion">  Dirección </label>
						<textarea rows="3" style="resize:none;" class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="direccion" name="direccion" data-id="{{$config->id}}" data-table="configuracion" data-campo="direccion">{{ $config->direccion }}</textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-4 p-2">
			<div class=" h-100 card" style="border-radius: 16px; box-shadow: none;">
				<div class="card-body">
					<h5 class="card-title text-center">Autentificación</h5>
					<div class="form-group">
						<label for="remitente"> Remitente</label>
						<input type="text" class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="remitente" name="remitente" data-id="{{$config->id}}" data-table="configuracion" data-campo="remitente"  value="{{ $config->remitente }}">
					</div>
					<div class="form-group">
						<label for="remitentepass"> Contraseña</label>
						<input type="text" class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="remitentepass" name="remitentepass" data-id="{{$config->id}}" data-table="configuracion" data-campo="remitentepass"  value="{{ $config->remitentepass }}">
					</div>
					<div class="form-group">
						<label for="remitentehost"> Servidor</label>
						<input type="text" class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="remitentehost" name="remitentehost" data-id="{{$config->id}}" data-table="configuracion" data-campo="remitentehost"  value="{{ $config->remitentehost }}">
					</div>
					<div class="form-group">
						<label for="remitenteport"> Puerto</label>
						<input type="text" class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="remitenteport" name="remitenteport" data-id="{{$config->id}}" data-table="configuracion" data-campo="remitenteport"  value="{{ $config->remitenteport }}">
					</div>
					<div class="form-group">
						<label for="remitenteseguridad">  Seguridad </label>
						<select class="form-control editar_text_seccion_global editarajax" data-url="{{route('textglobalseccion')}}" id="remitenteseguridad" name="remitenteseguridad" data-id="{{$config->id}}" data-table="configuracion" data-campo="remitenteseguridad"  value="{{ $config->remitenteseguridad }}">
							<option value="ssl">SSL</option>
							<option value="tls">TLS</option>
							<option value="starttls">STARTTLS</option>
						</select>
					</div>
				</div>
			</div>
		</div>

	</div>

@endsection

@section('jsLibExtras2')
<script>


$('.editar_text_seccion_global').change(function(e) {
    var id = $(this).attr("data-id");
    var tabla = $(this).attr("data-table");
    var campo = $(this).attr("data-campo");
    var valor = ($(this).val() === '') ? null : $(this).val();
    var tcsrf = $('meta[name="csrf-token"]').attr('content');
    // var url = $(this).attr("data-url");
    console.log("Valor antes de la llamada AJAX: " + valor);
    console.log(id);
    console.log(tabla);
    console.log(campo);
    console.log(valor);
    console.log(tcsrf);
    console.log(url);

    $.ajax({
        // url: '/advanced/varios/editarajax',
        url: '/varios/editarajax',
        type: 'post',
        dataType: 'json',
        data: {
            "id": id,
            "_method": 'post',
            "_token": tcsrf,
            "tabla": tabla,
            "campo": campo,
            "valor": valor
        }
    })
    .done(function(msg) {
        if (msg.success) {
            toastr["success"]("Guardado Exitosamente");
        }else {
            toastr["error"]("Error al actualizar");
        }
    })
    .fail(function(msg) {
        console.log("error:");
        console.log(msg);
    });

});

$('.editarajax').change(function(e) {
    var id = $(this).attr("data-id");
    var tabla = $(this).attr("data-table");
    var campo = $(this).attr("data-campo");
    var valor = ($(this).val() === '') ? null : $(this).val();
    var tcsrf = $('meta[name="csrf-token"]').attr('content');

    console.log(id);
    console.log(tabla);
    console.log(campo);
    console.log(valor);
    console.log(tcsrf);

    $.ajax({
        // url: '/advanced/varios/editarajax',
         url: '/varios/editarajax',
        //url: 'https://proyectoswozial.com/PepeFester/varios/editarajax',
        type: 'post',
        dataType: 'json',
        data: {
            "id": id,
            "_method": 'post',
            "_token": tcsrf,
            "tabla": tabla,
            "campo": campo,
            "valor": valor
        }
    })
    .done(function(msg) {
        console.log(msg);
        if (msg.success) {
        	toastr["success"]("Guardado Exitosamente");
        }else {
        	toastr["error"]("Error al actualizar");
        }
    })
    .fail(function(msg) {
        console.log("error:");
        console.log(msg);
    });
    // .always(function(msg) {
    // 	console.log("complete");
    // 	// console.log(msg);
    // });
});

</script>
@endsection
