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
        <a href="{{ route('seccion.show', ['slug' => 'usuarios']) }}" class="mt-5 col col-md-2 btn btn-sm btn-dark mr-auto"><i class="fa fa-reply"></i> Regresar</a>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col px-5">
                        <div class="card">
                            <div class="row">
                                <div class="col-9 py-2 mx-auto">
                                    <div style="
                                        background-image: url('{{ ($vendedor->imagen != null) ? asset('img/photos/usuarios/'.$vendedor->imagen) : asset('img/photos/usuarios/default.png') }}');
                                        background-position: center center;
                                        background-repeat: no-repeat;
                                        background-size: contain;
                                        height: 20rem;
                                        width: 100%;
                                    "></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-center fs-5">
                                        {{ $vendedor->name }} {{ $vendedor->lastname }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-5 rounded bg-white">
                <div class="row">
                    <div class="col bg-white fs-5 py-1">Telefono: {{ $vendedor->telefono }}</div>
                </div>
                <div class="row">
                    <div class="col bg-white fs-5 py-1">Correo: {{ $vendedor->email }}</div>
                </div>
                <div class="row">
                    <div class="col bg-white fs-5 py-1">Facebook: {{ $vendedor->facebook }}</div>
                </div>
                <div class="row">
                    <div class="col bg-white fs-5 py-1">Registrado: {{ $vendedor->created_at->format('d/m/Y') }}</div>
                </div>
            </div>
        </div>
        
    </div>


@endsection

@section('extraJS')

@endsection

