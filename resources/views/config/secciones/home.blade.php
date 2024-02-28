@extends('layouts.admin')

@section('content')

<div class="row mt-5 mb-4 px-2">
    <a href="{{ route('front.admin') }}" class="mt-5 col col-md-2 btn btn-sm btn-dark mr-auto"><i class="fa fa-reply"></i> Regresar</a>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <textarea name="" id="" cols="30" rows="6" class="form-control editar_text_seccion_global border border-secondary bg-transparent editarajax" data-url="{{route('textglobalseccion')}}" data-table="Elemento" data-campo="texto" data-id="{{ $elem_general[0]->id }}">{{ $elem_general[0]->texto }}</textarea>
        </div>
    </div>
</div>

@endsection

