@extends('layouts.admin')

@section('extraCSS')
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

    .contadorBtn {
        padding: 10px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

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

    <div class="container-fluid py-5 bg-white rounded">
        <div class="row">
            <div class="col fs-1 text-center">
                Cotizaciones
            </div>
        </div>
        <div class="row">
            <div class="col fs-5">
                Filtros de búsqueda
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <button type="button" id="filtrarMeses" class="btn btn-dark w-100 rounded-0">Ultimos 3 meses</button>
            </div>
            <div class="col-2">
                <button type="button" id="filtrarNoAsesor" class="btn btn-dark w-100 rounded-0">Sin asesor</button>
            </div>
            <div class="col-2">
                <button type="button" id="filtrarAsesor" class="btn btn-dark w-100 rounded-0">Con asesor</button>
            </div>
            <div class="col-2">
                <button type="button" id="filtrarFechaContacto" class="btn btn-dark w-100 rounded-0">Fecha contacto</button>
            </div>
            <div class="col-2">
                <button type="button" id="filtrarFechaCompra" class="btn btn-dark w-100 rounded-0">Fecha compra</button>
            </div>
            <div class="col-2">
                <button type="button" id="filtrarLimpiar" class="btn btn-dark w-100 rounded-0">Limpiar</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row border border-dark py-2">
                            <div class="col-md-2 col-12 fs-5 border-end">Cotización</div>
                            <div class="col-md-1 col-12 fs-5 border-end">Fecha</div>
                            <div class="col-md-2 col-12 fs-5 border-end">Asesor/Vendedor</div>
                            <div class="col-md-3 col-12 fs-5 border-end border-start">Cliente</div>
                            <div class="col-md-2 col-12 fs-5 border-end">Estatus</div>
                            <div class="col-md-2 col-12 fs-5">Acciones</div>
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
                    {{-- <li class="list-group-item"> --}}
                        @foreach ($pedidos as $item)
                            <div class="list-group-item lista-cotizacion">
                                <div class="row  d-flex align-items-center justify-content-center">
                                    <div class="col-md-2 col-12  py-1 fw-bolder">{{ $item->uid }}</div>
                                    <div class="col-md-1 col-12 py-1 border-end border-start border-dark">
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </div>
                                    <div class="col-md-2 col-12 py-1 with-vendor">
                                        @php
                                            $aux = 0;
                                        @endphp
                                        @foreach ($vendedores as $vend)
                                            @if ($vend->id == $item->vendedor)
                                                {{ $vend->name }} {{ $vend->lastname }}
                                                @php
                                                    $aux++;
                                                @endphp
                                                @break
                                            @endif
                                        @endforeach
                                        @if ($aux == 0)
                                            NINGUNO
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-12 boder-end border-start border-dark ">
                                        @foreach ($clientes as $clie)
                                            @if ($clie->id == $item->usuario)
                                                {{ $clie->name }} {{ $clie->lastname }}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div id="contadorBtn-{{ $item->id }}" class="col-md-2 col-12 contadorBtn boton-asignado text-center text-uppercase text-white fs-5" data-estatus="{{ $item->estatus }}" onclick="cambiarEstado('contadorBtn-{{ $item->estatus }}')">
                                        Asignado
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <div class="row">
                                            <div class="col-md-6 col-12 py-1">
                                                <button class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#cotizacion-detalle-{{ $item->id }}">
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
                                <div class="modal fade" id="cotizacion-detalle-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cotizacion-detalle-label-{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="cotizacion-detalle-label-{{ $item->id }}">Detalle de la cotización</h1>
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
                            </div>
                        @endforeach
                    {{-- </li> --}}
                </ul>
            </div>
        </div>
    </div>

@endsection

@section('extraJS')
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
                    // toastr.warning('Cancelado');
                    break;
                case 1:
                    boton.textContent = 'Asignado';
                    boton.classList.add('boton-asignado');
                    // toastr.warning('Producto asignado');
                    break;
                case 2:
                    boton.textContent = 'Pagado';
                    boton.classList.add('boton-pagado');
                    // toastr.warning('Producto pagado');
                    break;
                case 3:
                    boton.textContent = 'Enviado';
                    boton.classList.add('boton-enviado');
                    // toastr.warning('Producto enviado');
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

<script>
    $(document).ready(function () {
        // Evento clic para el botón #filtrarNoAsesor
        $('#filtrarNoAsesor').click(function () {
            // Oculta todos los elementos de cotización
            $('.lista-cotizacion').hide();
            
            // Muestra solo los elementos de cotización cuyo vendedor sea null
            $('.lista-cotizacion').each(function() {
                if ($(this).find('.with-vendor').text().trim() == 'NINGUNO') {
                    $(this).show();
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Evento clic para el botón #filtrarAsesor
        $('#filtrarAsesor').click(function () {
            // Oculta todos los elementos de cotización
            $('.lista-cotizacion').hide();
            
            // Muestra solo los elementos de cotización cuyo vendedor no sea null
            $('.lista-cotizacion').each(function() {
                if ($(this).find('.with-vendor').text().trim() !== 'NINGUNO') {
                    $(this).show();
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Evento clic para el botón #filtrarLimpiar
        $('#filtrarLimpiar').click(function () {
            // Muestra todos los elementos de cotización
            $('.lista-cotizacion').show();
        });
    });
</script>

<script>
    $(document).ready(function () {
        // Evento clic para el botón #filtrarFechaCompra
        $('#filtrarFechaCompra').click(function () {
            // Oculta todos los elementos de cotización
            $('.lista-cotizacion').hide();

            // Obtiene todos los elementos de cotización y los convierte en un array
            var cotizaciones = $('.lista-cotizacion').toArray();

            // Ordena los elementos de cotización por fecha de creación
            cotizaciones.sort(function(a, b) {
                var fechaA = new Date($(a).find('.col-md-1').text());
                var fechaB = new Date($(b).find('.col-md-1').text());
                return fechaA - fechaB;
            });

            // Muestra los elementos de cotización ordenados por fecha de creación
            cotizaciones.forEach(function(cotizacion) {
                $(cotizacion).show();
            });
        });
    });
</script>


@endsection

