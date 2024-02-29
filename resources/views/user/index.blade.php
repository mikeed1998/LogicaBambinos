@extends('layouts.app')

@section('content')

    <style>
        :root {
            --blanco: #FFFFFF;
            --negro: #000000;
            --status-pendiente: #FFA500;
            --status-confirmado: #ADD8E6;
            --status-procesado: #007BFF;
            --status-enviado: #008000;
            --status-entregado: #006400;
            --status-cancelado: #FF0000;
            --status-devuelto: #800080;
            --status-reembolsado: #B0C4DE;
        }

        .boton-pendiente { background-color: var(--status-pendiente); }
        .boton-confirmado { background-color: var(--status-confirmado); }
        .boton-procesado { background-color: var(--status-procesado); }
        .boton-enviado { background-color: var(--status-enviado); }
        .boton-entregado { background-color: var(--status-entregado); }
        .boton-cancelado { background-color: var(--status-cancelado); }
        .boton-devuelto { background-color: var(--status-devuelto); }
        .boton-reembolsado { background-color: var(--status-reembolsado); }

        body {
            background-color: var(--morado-fondo);
        }

    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-11 card border mx-auto mt-5">
                <div class="row">
                    <div class="col-md-3 col-12 border py-5">
                        <div class="list-group">
                            @if (session('status_usuario'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status_usuario') }}
                                </div>
                            @endif
                            <a class="list-group-item list-group-item-action fs-5 text-center disabled" aria-disabled="true">Bienvenido {{ $usuario->name }}</a>
                            <a class="list-group-item list-group-item-action fs-5 text-center disabled" aria-disabled="true">
                                <img src="{{ ($usuario->imagen == '') ? asset('img/photos/usuarios/default.png') : asset('img/photos/usuarios/'.$usuario->imagen) }}" alt="" class="img-fluid p-5">
                                <button class="btn btn-dark">Cambiar imagen</button>
                            </a>
                            <a href="#" id="link-mi-cuenta" class="list-group-item list-group-item-action">Mi cuenta</a>
                            <a href="#" id="link-mis-datos" class="list-group-item list-group-item-action">Datos de envío</a>
                            <a href="#" id="link-mis-pedidos" class="list-group-item list-group-item-action">Mis pedidos</a>
                            <a href="#" id="link-mis-pedidos" class="list-group-item list-group-item-action">
                                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9 col-12 border">
                        <div class="row">
                            <div class="col-12 mi-cuenta-container">
                                <div class="row">
                                    <div class="col-11 mx-auto py-1 border mt-5">
                                        <div class="row">
                                            <div class="col fs-3 py-3 text-center">Mi Cuenta</div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_nombre_usuario">Nombre(s)</label>
                                                <input type="text" name="dash_nombre_usuario" id="dash_nombre_usuario" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_apellidos_usuario">Apellido(s)</label>
                                                <input type="text" name="dash_apellidos_usuario" id="dash_apellidos_usuario" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_usuario_usuario">Nombre de usuario</label>
                                                <input type="text" name="dash_usuario_usuario" id="dash_usuario_usuario" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_telefono_usuario">Telefono</label>
                                                <input type="text" name="dash_telefono_usuario" id="dash_telefono_usuario" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_fecha_nacimiento_usuario">Fecha de nacimiento</label>
                                                <input type="date" name="dash_fecha_nacimiento_usuario" id="dash_fecha_nacimiento_usuario" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_rfc_usuario">RFC</label>
                                                <input type="text" name="dash_rfc_usuario" id="dash_rfc_usuario" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mis-datos-container">
                                <div class="row">
                                    <div class="col-11 mx-auto py-1 border mt-5">
                                        <div class="row">
                                            <div class="col fs-3 py-3 text-center">Mis datos de envio</div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_calle_usuario">Calle(s)</label>
                                                <input type="text" name="dash_calle_usuario" id="dash_calle_usuario" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_numero_exterior_usuario">Número exterior</label>
                                                <input type="text" name="dash_numero_exterior_usuario" id="dash_numero_exterior_usuario" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_numero_interior_usuario">Número interior</label>
                                                <input type="text" name="dash_numero_interior_usuario" id="dash_numero_interior_usuario" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_pais_usuario">País</label>
                                                <input type="text" name="dash_pais_usuario" id="dash_pais_usuario" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_estado_usuario">Estado</label>
                                                <input type="date" name="dash_estado_usuario" id="dash_estado_usuario" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_municipio_usuario">Municipio</label>
                                                <input type="text" name="dash_municipio_usuario" id="dash_municipio_usuario" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_colonia_usuario">Colonia</label>
                                                <input type="date" name="dash_colonia_usuario" id="dash_colonia_usuario" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-12 py-2">
                                                <label for="dash_codigo_postal_usuario">Código Postal</label>
                                                <input type="text" name="dash_codigo_postal_usuario" id="dash_codigo_postal_usuario" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mis-pedidos-container">
                                <div class="row">
                                    <div class="col-11 mx-auto py-1 border fs-3 text-center mt-5">
                                        Mis pedidos
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col border">
                                        <div class="row">
                                            <div class="col-md-6 py-2 col-12 border border-dark fs-5">
                                                Orden
                                            </div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">
                                                Fecha
                                            </div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">
                                                Estatus
                                            </div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">
                                                Acciones
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-md-6 py-2 col-12 border border-dark fs-5">FKJ3H34J3KJ43J43H4J3</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">{{ $fechaActual }}</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5 px-0"><a href="#/" class="nav-link h-100 h-100 w-100 text-center text-dark rounded-0 boton-pendiente">Pendiente</a></div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">
                                                <div class="row">
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-dark rounded-circle">
                                                            <small><i class="bi bi-eye text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-info rounded-circle">
                                                            <small><i class="bi bi-pencil-square text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-danger rounded-circle">
                                                            <small><i class="bi bi-trash text-white"></i></small>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 py-2 col-12 border border-dark fs-5">FKJ3H34J3KJ43J43H4J3</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">{{ $fechaActual }}</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5 text-center boton-confirmado px-0">Confirmado</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">
                                                <div class="row">
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-dark rounded-circle">
                                                            <small><i class="bi bi-eye text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-info rounded-circle">
                                                            <small><i class="bi bi-pencil-square text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-danger rounded-circle">
                                                            <small><i class="bi bi-trash text-white"></i></small>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 py-2 col-12 border border-dark fs-5">FKJ3H34J3KJ43J43H4J3</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">{{ $fechaActual }}</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5 px-0"><a href="#/" class="nav-link h-100 w-100 text-center text-dark rounded-0 boton-procesado">Procesado</a></div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">
                                                <div class="row">
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-dark rounded-circle">
                                                            <small><i class="bi bi-eye text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-info rounded-circle">
                                                            <small><i class="bi bi-pencil-square text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-danger rounded-circle">
                                                            <small><i class="bi bi-trash text-white"></i></small>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 py-2 col-12 border border-dark fs-5">FKJ3H34J3KJ43J43H4J3</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">{{ $fechaActual }}</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5 px-0"><a href="#/" class="nav-link h-100 w-100 text-center text-dark rounded-0 boton-enviado">Enviado</a></div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">
                                                <div class="row">
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-dark rounded-circle">
                                                            <small><i class="bi bi-eye text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-info rounded-circle">
                                                            <small><i class="bi bi-pencil-square text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-danger rounded-circle">
                                                            <small><i class="bi bi-trash text-white"></i></small>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 py-2 col-12 border border-dark fs-5">FKJ3H34J3KJ43J43H4J3</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">{{ $fechaActual }}</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5 px-0"><a href="#/" class="nav-link h-100 w-100 text-center text-dark rounded-0 boton-entregado">Entregado</a></div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">
                                                <div class="row">
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-dark rounded-circle">
                                                            <small><i class="bi bi-eye text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-info rounded-circle">
                                                            <small><i class="bi bi-pencil-square text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-danger rounded-circle">
                                                            <small><i class="bi bi-trash text-white"></i></small>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 py-2 col-12 border border-dark fs-5">FKJ3H34J3KJ43J43H4J3</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">{{ $fechaActual }}</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5 px-0"><a href="#/" class="nav-link h-100 w-100 text-center text-dark rounded-0 boton-cancelado">Cancelado</a></div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">
                                                <div class="row">
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-dark rounded-circle">
                                                            <small><i class="bi bi-eye text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-info rounded-circle">
                                                            <small><i class="bi bi-pencil-square text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-danger rounded-circle">
                                                            <small><i class="bi bi-trash text-white"></i></small>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 py-2 col-12 border border-dark fs-5">FKJ3H34J3KJ43J43H4J3</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">{{ $fechaActual }}</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5 px-0"><a href="#/" class="nav-link h-100 w-100 text-center text-dark rounded-0 boton-devuelto">Devuelto</a></div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">
                                                <div class="row">
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-dark rounded-circle">
                                                            <small><i class="bi bi-eye text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-info rounded-circle">
                                                            <small><i class="bi bi-pencil-square text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-danger rounded-circle">
                                                            <small><i class="bi bi-trash text-white"></i></small>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 py-2 col-12 border border-dark fs-5">FKJ3H34J3KJ43J43H4J3</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">{{ $fechaActual }}</div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5 px-0"><a href="#/" class="nav-link h-100 w-100 text-center text-dark rounded-0 boton-reembolsado">Reembolsado</a></div>
                                            <div class="col-md-2 py-2 col-12 border border-dark fs-5">
                                                <div class="row">
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-dark rounded-circle">
                                                            <small><i class="bi bi-eye text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-info rounded-circle">
                                                            <small><i class="bi bi-pencil-square text-white"></i></small>
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn-sm btn-danger rounded-circle">
                                                            <small><i class="bi bi-trash text-white"></i></small>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('jqueryExtra')
    <script>
        $(document).ready(function() {
            // Función para ocultar todos los contenedores
            function hideAllContainers() {
                $('.mi-cuenta-container, .mi-carrito-container, .mis-datos-container, .mis-pedidos-container').hide();
            }

            $('#link-mi-cuenta').click(function(e) {
                e.preventDefault();
                hideAllContainers();
                $('.mi-cuenta-container').show();
            });

            $('#link-mis-datos').click(function(e) {
                e.preventDefault();
                hideAllContainers();
                $('.mis-datos-container').show();
            });

            $('#link-mis-pedidos').click(function(e) {
                e.preventDefault();
                hideAllContainers();
                $('.mis-pedidos-container').show();
            });

            // Inicialmente muestra solo el contenedor de "Mi cuenta"
            hideAllContainers();
            $('.mi-cuenta-container').show();
        });
    </script>
@endsection
