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
        <a href="{{ route('front.admin') }}" class="mt-5 col col-md-2 btn btn-sm btn-dark mr-auto"><i class="fa fa-reply"></i> Regresar</a>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 text-center my-3">
			<div class="card">
				<form action="{{ route('config.politica.update',$politicas[0]->id) }}" method="post" class="card-body">
					@csrf
					@method('put')
					<label class="h5">{{$politicas[0]->titulo}}</label>
					<textarea name="descripcion" rows="10">{{$politicas[0]->descripcion}}</textarea>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</form>
			</div>
		</div>
    </div>

@endsection

@section('extraJS')

@endsection

