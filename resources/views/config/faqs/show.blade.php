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

    <div class="col-12 col-md-8 mx-auto">
		<div class="card">
			<div class="card-body">
				<div class="card">
                    <div class="card-body">
                        {{$faq->pregunta}}
                    </div>
                </div>
                <div class="card py-5">
                    <div class="card-body">
                        {{$faq->respuesta}}
                    </div>
                </div>
			</div>
		</div>
	</div>

@endsection

@section('extraJS')

@endsection

