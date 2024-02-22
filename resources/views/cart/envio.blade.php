@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>DATOS DE ENVIO</h1>
                <a href="{{ route('clip.index') }}" class="btn btn-success">Proceder con el pago</a>
            </div>
        </div>
    </div>
@endsection
