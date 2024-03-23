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

    <div class="container-fluid py-5 rounded bg-white mb-3">
        <div class="row">
            <div class="col text-center fs-1 py-3">
                Lista de ususarios
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <button type="button" id="btnClientes" class="btn btn-dark w-100 rounded-0 fs-5">Clientes</button>
            </div>
            <div class="col-6">
                <button type="button" id="btnVendedores" class="btn btn-dark w-100 rounded-0 fs-5">Vendedores</button>
            </div>  
        </div>
    </div>

    <div class="container-fluid bg-white rounded py-4" id="lista-clientes" style="display: none;">
        <div class="row">
            <div class="col fs-2 py-2 text-center">
                Lista de clientes
            </div>
        </div>
        @foreach ($usuarios as $cliente)
            @if ($cliente->role_as == 0)
                <div class="row d-flex align-items-center justify-content-center border shadow">
                    <div class="col-1">
                        <div style="
                            background-image: url('{{ asset('img/photos/usuarios/'.$cliente->imagen) }}');
                            background-position: center center;
                            background-repeat: no-repeat;
                            background-size: contain;
                            width: 100%;
                            height: 6rem;
                        "></div>
                    </div>
                    <div class="col-5 border">
                        {{ $cliente->name }} {{ $cliente->lastname }}
                    </div>
                    <div class="col-6 border">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('clientes.cliente.compras_cliente', ['id' => $cliente->id]) }}" class="btn w-100 rounded-0 btn-outline-dark">Historial de compras</a>
                            </div>
                            <div class="col">
                                <a href="{{ route('clientes.cliente.detalle_cliente', ['id' => $cliente->id]) }}" class="btn w-100 rounded-0 btn-outline-dark">Detalles de la cuenta</a>
                            </div>
                            <div class="col">
                                <a href="#/" class="btn w-100 rounded-0 btn-outline-dark">Modificar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="container-fluid bg-white rounded py-4" id="lista-vendedores" style="display: none;">
        <div class="row">
            <div class="col fs-5 text-center">
                Lista de vendedores
            </div>
        </div>
        @foreach ($usuarios as $vendedor)
            @if ($vendedor->role_as == 2)
                <div class="row d-flex align-items-center justify-content-center border shadow">
                    <div class="col-1">
                        <div style="
                            background-image: url('{{ asset('img/photos/usuarios/'.$vendedor->imagen) }}');
                            background-position: center center;
                            background-repeat: no-repeat;
                            background-size: contain;
                            width: 100%;
                            height: 6rem;
                        "></div>
                    </div>
                    <div class="col-5 border">
                        {{ $vendedor->name }} {{ $vendedor->lastname }}
                    </div>
                    <div class="col-6 border">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('vendedores.vendedor.detalle_vendedor', ['id' => $vendedor->id]) }}" class="btn w-100 rounded-0 btn-outline-dark">Detalles cuenta</a>
                            </div>
                            <div class="col">
                                <a href="{{ route('vendedores.vendedor.cotizaciones_vendedor', ['id' => $vendedor->id]) }}" class="btn w-100 rounded-0 btn-outline-dark">Cotizaciones</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

@endsection

@section('extraJS')
    <script>
        $('#btnClientes').click(function() {
            $('#lista-clientes').show();
            $('#lista-vendedores').hide();
        });

        $('#btnVendedores').click(function() {
            $('#lista-clientes').hide();
            $('#lista-vendedores').show();
        });
    </script>

@endsection

