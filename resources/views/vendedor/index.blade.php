@extends('layouts.app')

@section('content')

<style>
    .contadorBtn {
        padding: 10px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .inactivo {
        background-color: #d3d3d3; /* Gris claro para inactivo */
    }

    .ordenado {
        background-color: #ffcc00; /* Amarillo para ordenado */
    }

    .pagado {
        background-color: #4caf50; /* Verde para pagado */
    }

    .enviado {
        background-color: #3498db; /* Azul para enviado */
    }
</style>

<div class="container-fluid py-5" style="font-family: sans-serif;">
    <div class="row justify-content-center">
        <div class="col-md-9 col-12">
            <div class="card">
                <div class="card-header">PANEL USUARIO (VENDEDOR)</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col py-3">
                            <div class="card">
                                <img src="{{ ($usuario->imagen == '') ? asset('img/photos/vendedores/default.png') : asset('img/photos/vendedores/'.$usuario->imagen) }}" alt="" class="img-fluid w-25">
                                <div class="card-body">
                                    <h5 class="card-title fs-1">Lista de cotizaciones</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-6 col-12 fs-4 border-end">Cotización</div>
                                            <div class="col-md-2 col-12 fs-4 border-end">Estatus</div>
                                            <div class="col-md-4 col-12 fs-4">Acciones</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-6 col-12 fs-5 py-1">Primera cotización</div>
                                            <div class="col-md-2 col-12"><div id="contadorBtn-1" class="contadorBtn inactivo text-center" onclick="cambiarEstado('contadorBtn-1')">Inactivo</div></div>
                                            <div class="col-md-4 col-12">
                                                <div class="row">
                                                    <div class="col-md-4 col-12 py-1">
                                                        <a href="#/" class="btn w-100 btn-info">Detalle</a>
                                                    </div>
                                                    <div class="col-md-4 col-12 py-1">
                                                        <a href="#/" class="btn w-100 btn-primary">Actualizar</a>
                                                    </div>
                                                    <div class="col-md-4 col-12 py-1">
                                                        <a href="#/" class="btn w-100 btn-danger">Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-6 col-12 fs-5 py-1">Segunda cotización</div>
                                            <div class="col-md-2 col-12"><div id="contadorBtn-2" class="contadorBtn inactivo text-center" onclick="cambiarEstado('contadorBtn-2')">Inactivo</div></div>
                                            <div class="col-md-4 col-12">
                                                <div class="row">
                                                    <div class="col-md-4 col-12 py-1">
                                                        <a href="#/" class="btn w-100 btn-info">Detalle</a>
                                                    </div>
                                                    <div class="col-md-4 col-12 py-1">
                                                        <a href="#/" class="btn w-100 btn-primary">Actualizar</a>
                                                    </div>
                                                    <div class="col-md-4 col-12 py-1">
                                                        <a href="#/" class="btn w-100 btn-danger">Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-6 col-12 fs-5 py-1">Tercera cotización</div>
                                            <div class="col-md-2 col-12"><div id="contadorBtn-3" class="contadorBtn inactivo text-center" onclick="cambiarEstado('contadorBtn-3')">Inactivo</div></div>
                                            <div class="col-md-4 col-12">
                                                <div class="row">
                                                    <div class="col-md-4 col-12 py-1">
                                                        <a href="#/" class="btn w-100 btn-info">Detalle</a>
                                                    </div>
                                                    <div class="col-md-4 col-12 py-1">
                                                        <a href="#/" class="btn w-100 btn-primary">Actualizar</a>
                                                    </div>
                                                    <div class="col-md-4 col-12 py-1">
                                                        <a href="#/" class="btn w-100 btn-danger">Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <a href="{{ route('vendedor.create') }}" class="btn btn-dark">Agregar nueva cotización</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="col-12">
                                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            // Definir el número total de botones
            const totalBotones = 3;

            // Función para cambiar el estado de un botón
            function cambiarEstado(id) {
                const contadorBtn = document.getElementById(id);
                let estadoActual = 1;

                function actualizarEstado() {
                    contadorBtn.classList.remove('inactivo', 'ordenado', 'pagado', 'enviado');

                    switch (estadoActual) {
                        case 1:
                            contadorBtn.textContent = 'Inactivo';
                            contadorBtn.classList.add('inactivo');
                            toastr.warning('Cotización inactiva', 'Estatus - Inactivo');
                            break;
                        case 2:
                            contadorBtn.textContent = 'Ordenado';
                            contadorBtn.classList.add('ordenado');
                            toastr.warning('Cotización ordenada', 'Estatus - Ordenada');
                            break;
                        case 3:
                            contadorBtn.textContent = 'Pagado';
                            contadorBtn.classList.add('pagado');
                            toastr.warning('Cotización Pagada', 'Estatus - Pagada');
                            break;
                        case 4:
                            contadorBtn.textContent = 'Enviado';
                            contadorBtn.classList.add('enviado');
                            toastr.warning('Cotización enviada', 'Estatus - Enviado');
                            break;
                        default:
                            break;
                    }
                }

                contadorBtn.addEventListener('click', function() {
                    estadoActual = (estadoActual % 4) + 1;
                    actualizarEstado();
                });
            }

            // Llamar a cambiarEstado para cada botón
            for (let i = 1; i <= totalBotones; i++) {
                cambiarEstado(`contadorBtn-${i}`);
            }
        });

    </script>
@endsection
