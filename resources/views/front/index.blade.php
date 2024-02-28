@extends('layouts.app')

@section('titulo', 'Home')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>PAGINA FRONT PUBLICO</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                Formulario
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="{{ route('correo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tipoCorreo" value="FormularioContacto">
                    <input type="submit" value="Testear">
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection

