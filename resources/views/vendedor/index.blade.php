@extends('layouts.app')

@section('content')

<style>
    :root {
        --blanco: #FFFFFF;
        --negro: #000000;
        --status-cancelado: #FF0000;
        --status-asignado: #FFA500;
        --status-pagado: #006400;
        --status-enviado: #007BFF;
    }

    .boton-cancelado { background-color: var(--status-cancelado); }
    .boton-asignado { background-color: var(--status-asignado); }
    .boton-pagado { background-color: var(--status-pagado); }
    .boton-enviado { background-color: var(--status-enviado); }

    body {
        background-color: var(--morado-fondo);
    }

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

<style>
    .file-upload input[type="file"], .file-upload2 input[type="file"] {
        position: absolute;
        left: -9999px;
    }

    .file-upload label, .file-upload2 label {
        display: inline-block;
        background-color: #00000031;
        color: #fff;
        padding: 6px 12px;
        cursor: pointer;
        border-radius: 4px;
        font-weight: normal;
        opacity: 0%;
    }

    .file-upload input[type="file"] + label:before, .file-upload2 input[type="file"] + label:before {
        content: "\f07b";
        font-family: "Font Awesome 5 Free";
        font-size: 16px;
        margin-right: 5px;
        transition: all 0.5s;
    }

    .file-upload input[type="file"] + label, .file-upload2 input[type="file"] + label {
        transition: all 0.5s;
    }

    .file-upload input[type="file"]:focus + label, .file-upload2 input[type="file"]:focus + label,
    .file-upload input[type="file"] + label:hover, .file-upload2 input[type="file"] + label:hover {
        backdrop-filter: blur(5px);
        background-color: #41464a37;
        opacity: 100%;
        transition: all 0.5s;
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
                        <a class="list-group-item list-group-item-action fs-4 text-center disabled" aria-disabled="true">Vendedor - {{ $usuario->name }}</a>
                        <div class="list-group-item list-group-item-action fs-5 text-center ">
                            <img src="{{ asset('img/photos/usuarios/'.$usuario->imagen) }}" alt="" class="img-fluid p-5">
                            <form id="form_img_perfil" action="cambiar_imagen" method="POST" class="file-upload" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_imagen" value="{{ $usuario->id }}">
                                <input type="hidden" name="tipo_imagen" value="perfil_usuario">
                                <input id="img_perfil" class="m-0 p-0" type="file" name="archivo">
                                <label class="col-12 m-0 px-2 d-flex justify-content-center align-items-center" for="img_perfil" style=" height: 100%; opacity: 100%; border-radius: 20px;">Actualizar Imagen</label>
                            </form>
                            <script>
                                $('#img_perfil').change(function(e) {
                                    $('#form_img_perfil').trigger('submit');
                                });
                            </script>
                        </div>
                        <a href="#" id="link-mi-cuenta" class="list-group-item list-group-item-action fs-5">Mi cuenta</a>
                        <a href="#" id="link-mis-cotizaciones" class="list-group-item list-group-item-action fs-5">Cotizaciones</a>
                        <a href="#" id="link-mis-pedidos" class="list-group-item list-group-item-action fs-5">
                            <a class="btn btn-danger fs-5" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                        <div class="col-12 py-3 mi-cuenta-container">
                            <div class="row">
                                <div class="col fs-1 py-3 text-center">Mi Cuenta</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6 col-12 py-2">
                                    <label for="dash_nombre_usuario" class="fs-5">Nombre(s)</label>
                                    <input type="text" name="dash_nombre_usuario" id="dash_nombre_usuario" class="form-control fs-5 editarajax" data-model="User" data-field="name" data-id="{{$usuario->id}}"  value="{{ $usuario->name }}">
                                </div>
                                <div class="col-md-6 col-12 py-2">
                                    <label for="dash_apellidos_usuario" class="fs-5">Apellido(s)</label>
                                    <input type="text" name="dash_apellidos_usuario" id="dash_apellidos_usuario" class="form-control fs-5 editarajax" data-model="User" data-field="lastname" data-id="{{$usuario->id}}"  value="{{ $usuario->lastname }}">
                                </div>
                                {{-- <div class="col-md-6 col-12 py-2">
                                    <label for="dash_usuario_usuario" class="fs-5">Nombre de usuario</label>
                                    <input type="text" name="dash_usuario_usuario" id="dash_usuario_usuario" class="form-control fs-5 editarajax" data-model="User" data-field="name" data-id="{{$usuario->id}}"  value="{{ $usuario->name }}">
                                </div> --}}
                                <div class="col-md-6 col-12 py-2">
                                    <label for="dash_telefono_usuario" class="fs-5">Telefono</label>
                                    <input type="text" name="dash_telefono_usuario" id="dash_telefono_usuario" class="form-control fs-5 editarajax" data-model="User" data-field="telefono" data-id="{{$usuario->id}}"  value="{{ $usuario->telefono }}">
                                </div>
                                <div class="col-md-6 col-12 py-2">
                                    <label for="dash_fecha_nacimiento_usuario" class="fs-5">Fecha de nacimiento</label>
                                    <input type="date" name="dash_fecha_nacimiento_usuario" id="dash_fecha_nacimiento_usuario" class="form-control fs-5 editarajax" data-model="User" data-field="fecha_nacimiento" data-id="{{$usuario->id}}"  value="{{ $usuario->fecha_nacimiento }}">
                                </div>
                                <div class="col-md-6 col-12 py-2">
                                    <label for="dash_rfc_usuario" class="fs-5">RFC</label>
                                    <input type="text" name="dash_rfc_usuario" id="dash_rfc_usuario" class="form-control fs-5 editarajax" data-model="User" data-field="RFC" data-id="{{$usuario->id}}"  value="{{ $usuario->RFC }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-3 mis-cotizaciones-container">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title text-center fs-1">Lista de cotizaciones</div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="row border border-dark py-2">
                                            <div class="col-md-5 col-12 fs-4 border-end">Cotización</div>
                                            <div class="col-md-3 col-12 fs-4 border-end border-start">Cliente</div>
                                            <div class="col-md-2 col-12 fs-4 border-end">Estatus</div>
                                            <div class="col-md-2 col-12 fs-4">Acciones</div>
                                        </div>
                                    </li>
                                    @php
                                        $status_list = array(
                                            "",
                                            "cancelado",
                                            "asignado",
                                            "pagado",
                                            "enviado",
                                        );
                                    @endphp
                                    <li class="list-group-item">
                                        @foreach ($lista_cotizaciones as $item)
                                            
                                        
                                            <div class="row border border-dark">
                                                <div class="col-md-5 col-12 fs-5 py-1">Cotización {{ $item->uid }}</div>
                                                <div class="col-md-3 col-12 boder-end border-start border-dark fs-5">mikeed1998@gmail.com</div>
                                                <div id="contadorBtn-{{ $item->id }}" class="col-md-2 col-12 border-start border-end border-dark contadorBtn boton-asignado text-center text-uppercase text-white fs-5" data-estatus="{{ $item->estatus }}" onclick="cambiarEstado('contadorBtn-{{ $item->estatus }}')">
                                                    Asignado
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12 py-1">
                                                            <button class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#cotizacion-detalle">
                                                                <i class="bi bi-pencil-square text-white w-100"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-6 col-12 py-1">
                                                            <button class="btn btn-danger btn-delete w-100" data-id="{{ $item->id }}" @if ($item->estatus != 1) disabled @endif>
                                                                <i class="bi bi-trash text-white w-100"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="cotizacion-detalle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cotizacion-detalle-label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="cotizacion-detalle-label">Detalle de la cotización</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ...
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Volver al panel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <a href="{{ route('vendedor.create') }}" class="btn btn-dark">Agregar nueva cotización</a>
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
        document.addEventListener('DOMContentLoaded', function () {
            const botones = document.querySelectorAll('.contadorBtn');

            // Función para cambiar el estado de un botón según el estado actual del item
            function actualizarEstadoBoton(boton, estado) {
                // Remueve todas las clases de estado
                boton.classList.remove('boton-cancelado', 'boton-asignado', 'boton-pagado', 'boton-enviado');

                // Cambia el estado y el texto del botón según el estado del item
                switch (estado) {
                    case 0:
                        boton.textContent = 'Cancelado';
                        boton.classList.add('boton-cancelado');
                        toastr.warning('Cancelado');
                        break;
                    case 1:
                        boton.textContent = 'Asignado';
                        boton.classList.add('boton-asignado');
                        toastr.warning('Producto asignado');
                        break;
                    case 2:
                        boton.textContent = 'Pagado';
                        boton.classList.add('boton-pagado');
                        toastr.warning('Producto pagado');
                        break;
                    case 3:
                        boton.textContent = 'Enviado';
                        boton.classList.add('boton-enviado');
                        toastr.warning('Producto enviado');
                        break;
                    default:
                        break;
                }
            }

            // Itera sobre todos los botones y actualiza su estado inicial
            botones.forEach(function (boton) {
                // Extrae el ID del botón para obtener el estado del item
                const id = boton.id.split('-')[1]; // Suponiendo que el ID del botón es de la forma "contadorBtn-N"
                const estadoItem = obtenerEstadoItem(id); // Función para obtener el estado del item según su ID (debes implementarla)

                // Actualiza el estado del botón
                actualizarEstadoBoton(boton, estadoItem);

                // Si el estado es 0 o 1, bloquea el botón
                if (estadoItem === 0 || estadoItem === 1) {
                    boton.disabled = true;
                }

                // Agrega un event listener para cambiar el estado del botón al hacer clic en él
                boton.addEventListener('click', function () {
                    // Verifica si el estado es 0 o 1, en cuyo caso no se hace nada
                    if (estadoItem === 0 || estadoItem === 1) {
                        return;
                    }
                    
                    // Si el estado es "Pagado" (2), muestra una confirmación con SweetAlert
                    if (estadoItem === 2) {
                        Swal.fire({
                            title: '¿Deseas cambiar el estatus de este pedido a Enviado?',
                            text: "Antes de hacerlo confirma que el pedido ya esta preparado y fue enviado por la fabrica, así como haber confirmado que el pago se realizo exitosamente. Una vez confirmado no se podrá revertir.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, cambiar!',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // El usuario confirmó, cambiar el estado a "Enviado" (3)
                                const nuevoEstado = 3; // Estado "Enviado"
                                actualizarEstadoBoton(boton, nuevoEstado);
                                // Realizar acciones adicionales aquí, como actualizar en la base de datos
                                console.log('Botón ID:', boton.getAttribute('data-id'), 'Estado cambiado a:', nuevoEstado);
                            }
                        });
                    } else {
                        // Para otros estados, maneja el cambio de estado aquí sin confirmación
                        const nuevoEstado = (estadoItem + 1) % 4;
                        actualizarEstadoBoton(boton, nuevoEstado);
                        console.log('Botón ID:', boton.getAttribute('data-id'), 'Estado cambiado a:', nuevoEstado);
                    }
                });
            });

            // Función para simular la obtención del estado del item según su ID
            function obtenerEstadoItem(id) {
            // Aquí debes obtener el estado del ítem con el ID correspondiente
            // Puedes hacerlo utilizando el atributo "data-estatus" en el botón, por ejemplo
            const boton = document.getElementById('contadorBtn-' + id);
            const estatus = boton.getAttribute('data-estatus');

            // Retorna el estado obtenido
            return parseInt(estatus);
        }
    });

    </script>
    <script>
        $(document).ready(function() {
            // Función para ocultar todos los contenedores
            function hideAllContainers() {
                $('.mi-cuenta-container, .mis-cotizaciones-container').hide();
            }

            $('#link-mi-cuenta').click(function(e) {
                e.preventDefault();
                hideAllContainers();
                $('.mi-cuenta-container').show();
            });

            $('#link-mis-cotizaciones').click(function(e) {
                e.preventDefault();
                hideAllContainers();
                $('.mis-cotizaciones-container').show();
            });

            // Inicialmente muestra solo el contenedor de "Mi cuenta"
            hideAllContainers();
            $('.mi-cuenta-container').show();
        });
    </script>
    
    <script>
        $(document).ready(function () {
            $('.btn-delete').on('click', function () {
                const targetId = $(this).data('id'); // Obtiene el ID del elemento a eliminar
                const csrfToken = $('meta[name="csrf-token"]').attr('content'); // Obtiene el token CSRF

                Swal.fire({
                    title: '¿Eliminar cotización?',
                    text: 'Esta acción no se puede deshacer.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Realiza la petición AJAX para cambiar el estado del ítem a cancelado
                        $.ajax({
                            url: '{{ route("ajax.cancelar_cotizacion") }}', // Asegúrate de reemplazar esto por tu URL correcta
                            type: 'POST',
                            data: {
                                _token: csrfToken, // Incluye el token CSRF en la data de la solicitud
                                id: targetId,
                                estado: 0
                            },
                            success: function (data) {
                                Swal.fire(
                                    'Eliminado!',
                                    'La cotización ha sido eliminada.',
                                    'success'
                                );
                                
                                // actualizar boton
                                location.reload();
                            },
                            error: function (xhr, status, error) {
                                console.error('Error al cambiar el estado:', error);
                            }
                        });
                    }
                });
            });
        });

    </script>
@endsection
