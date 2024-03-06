@extends('layouts.admin')

@section('extraCSS')
    <style>

        body { background-color: #e5e8eb  !important; }

        .card-header { background-color: #b0c1d1  !important; }

        .black-skin
        .btn-primary { background-color: #b0c1d1  !important; }

        .btn {
            box-shadow: none;
            border-radius: 15px;
        }
    </style>
@endsection

@section('content')

    <div class="row mt-5 mb-4 px-2">
        <div class="col-6 text-start">
            <a href="{{ route('front.admin') }}" class="mt-5 w-50 col col-md-2 btn btn-sm btn-dark mr-auto"><i class="fa fa-reply"></i> Regresar</a>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('faqs.create') }}" class="mt-5 w-50 col col-md-2 btn btn-sm btn-success text-white"><i class="fa fa-plus"></i> Agregar</a>
        </div>
    </div>

    <div class="accordion sortable" data-table="Faq" id="acordionfaqs">
		@foreach ($faqs as $f)
            <div class="card" data-card="{{$f->id}}">
                <div class="row">
                    <div class="col-9">
                        <a href="{{ route('faqs.show', ['id' => $f->id]) }}" class="btn btn-link btn-block py-0 text-left fs-5" >
							{{ $f->pregunta}}
						</a>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ route('faqs.edit', ['id' => $f->id]) }}" class="btn btn-sm btn-info text-right w-100 rounded-0">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </a>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-sm btn-danger text-right w-100 rounded-0" data-toggle="modal" data-target="#frameModalDel" data-id="{{$f->id}}">
                                    <i class="bi bi-trash fs-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="card mb-3" data-card="{{$f->id}}">

				<div id="collapse{{$f->id}}" class="collapse" aria-labelledby="heading{{$f->id}}" data-parent="#acordionfaqs">
					<div class="card-body text-justify">
						{!! $f->respuesta!!}
					</div>
				</div>
			</div>
		@endforeach
	</div>

	<div class="modal fade bottom" id="frameModalDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-frame modal-top" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row d-flex justify-content-center align-items-center">
						<p class="pt-3 pr-2">
							Eliminar Pregunta?
						</p>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn red darken-3 text-white delslide">Eliminar</button>
						<form id="preguntadel" action="{{ route('faqs.destroy', ['faq' => 1]) }}" method="POST" style="display: none;">
								@csrf
								 @method('delete')
								<input type="hidden" id="iqdel" name="pregunta" value="">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('extraJS')
<script type="text/javascript">
    $(document).ready(function() {

        $('.fa-trash-alt').parent().click(function(e) {
            var id = $(this).attr('data-id');
            $("#iqdel").val(id);
        });

        $('.delslide').click(function(e) {
            $('#preguntadel').submit();
        });

    });
</script>
@endsection

