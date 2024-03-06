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

    <div class="container">
        <div class="row">
            <div class="col">
                <textarea name="" id="" cols="30" rows="6" class="form-control border border-secondary bg-transparent editarajax" data-table="Elemento" data-campo="texto" data-id="{{ $elem_general[0]->id }}">{{ $elem_general[0]->texto }}</textarea>
            </div>
        </div>
    </div>

@endsection

@section('extraJS')

@endsection

