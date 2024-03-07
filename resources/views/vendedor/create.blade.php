@extends('layouts.app')

@section('content')

    <style>
        body {
            background-color: var(--morado-fondo);
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-9 mx-auto py-3">
                <div class="row">
                    <div class="col-4">
                        <a href="{{ route('vendedor.home') }}" class="btn btn-danger w-100 rounded">Volver a mi panel</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-9 py-5 mx-auto border bg-white rounded">
                <div class="row">
                    <div class="col-9 mx-auto text-center fs-1">
                        Nueva orden
                    </div>
                </div>
                <div class="row py-5">
                    <div class="col-11 mx-auto text-center fs-4">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input fs-4" type="radio" name="radioBtn" id="ra1" value="option1" required>
                                    <label class="form-check-label fs-4" for="ra1">Mi cliente tiene cuenta</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input fs-4" type="radio" name="radioBtn" id="ra2" value="option2" required>
                                    <label class="form-check-label fs-4" for="ra2">Mi cliente no tiene cuenta</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 tiene-cuenta">
                        <div class="card py-5 h-100">
                            <div class="row">
                                <div class="col-9 mx-auto">
                                    <form action="{{ route('storeCotizacion') }}" method="POST" id="form-si">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="usuario_orden" class="form-control-label fs-5">Usuario al que deseas levantar la orden</label>
                                                <select name="usuario_orden" id="usuario_orden" class="form-control fs-5">
                                                    @foreach ($usuarios as $users)
                                                        <option value="{{ $users->id }}" class="fs-5">{{ $users->email }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col mx-auto">
                                                <label for="producto_cliente_orden" class="form-control-label fs-5">Producto que deseas cotizar a tu cliente</label>
                                                <select name="producto_cliente_orden" id="producto_cliente_orden" class="form-select fs-5">
                                                    @foreach ($productos as $p)
                                                        <option value="producto-{{ $p->id }}" class="fs-5">{{ $p->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col mx-auto">
                                                <label for="cantidad_cotizacion" class="form-control-label text-start fs-5">Cantidad</label>
                                                <input type="number" id="cantidad_cotizacion" name="cantidad_cotizacion" class="form-control fs-5">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col mt-2">
                                                <input type="submit" class="btn w-100 btn-success fs-5" value="Generar cotización">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 no-tiene-cuenta">
                        <div class="card py-5">
                            <div class="row">
                                <div class="col-9 mx-auto">
                                    <div class="row">
                                        <div class="col fs-4">
                                            <form action="{{ route('storeCliente') }}" method="POST" id="form-no">
                                                @csrf
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label for="nombre_cliente_orden" class="form-control-label fs-5">Nombre del cliente</label>
                                                        <input required type="text" id="nombre_cliente_orden" name="nombre_cliente_orden" class="form-control fs-5">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label for="email_cliente_orden" class="form-control-label fs-5">Correo del cliente</label>
                                                        <input required type="email" id="email_cliente_orden" name="email_cliente_orden" class="form-control fs-5">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label for="telefono_cliente_orden" class="form-control-label fs-5">Ingresa el teléfono del cliente</label>
                                                        <input required type="text" id="telefono_cliente_orden" name="telefono_cliente_orden" class="form-control fs-5">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label for="password_cliente_orden" class="form-control-label fs-5">Contraseña del cliente <br> (si lo dejas vacio, el télefono se usará como contraseña)</label>
                                                        <input type="text" id="password_cliente_orden" name="password_cliente_orden" class="form-control fs-5" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col mt-2">
                                                        <input type="submit" class="btn w-100 btn-success fs-5" value="Generar cuenta">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-5">
                    <div class="col">

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        var usuarioSeleccionado = "";  // Variable global para almacenar el usuario seleccionado
        var vendedorSeleccionado = "";
        var productoSeleccionado = "";
        var cantidadSeleccionada = "";

        function guardarUsuario() {
            var usuarioSelect = $('#usuario_orden');
            usuarioSeleccionado = usuarioSelect.val();
            console.log(usuarioSeleccionado);
        }
        function guardarYEnviar() {
            guardarUsuario();  // Guarda el usuario seleccionado antes de enviar los datos

            var productoClienteOrden = $('#producto_cliente_orden').val();
            var cantidadCotizacion = $('#cantidad_cotizacion').val();

            $.ajax({
                url: '{{ route('storeCotizacion') }}',
                method: 'POST',
                data: {
                    usuario_orden: usuarioSeleccionado,
                    producto_cliente_orden: productoClienteOrden,
                    cantidad_cotizacion: cantidadCotizacion,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log('Respuesta del servidor:', data);
                    toastr.success(data.message);
                },
                error: function (error) {
                    console.error('Hubo un error');
                }
            });
        }
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Obtener referencias a los elementos relevantes
            const radioTieneCuenta = document.getElementById('ra1');
            const radioNoTieneCuenta = document.getElementById('ra2');
            const selectUsuarioOrden = document.getElementById('usuario_orden');
            const inputsNoTieneCuenta = document.querySelectorAll('.no-tiene-cuenta input');
            const inputsSiTieneCuenta = document.querySelectorAll('.tiene-cuenta input');
            const selectsSiTieneCuenta = document.querySelectorAll('.tiene-cuenta select');
            const btnSeleccionarCuenta = document.querySelector('.tiene-cuenta input[type="submit"]');
            const btnGenerarCuenta = document.querySelector('.no-tiene-cuenta input[type="submit"]');

            // Función para habilitar o deshabilitar elementos según la selección del radio
            function gestionarEstadoElementos() {
                if (radioTieneCuenta.checked) {
                    selectUsuarioOrden.disabled = false;
                    inputsNoTieneCuenta.forEach(input => input.disabled = true);
                    inputsSiTieneCuenta.forEach(input => input.disabled = false);
                    selectsSiTieneCuenta.forEach(input => input.disabled = false);
                    btnSeleccionarCuenta.disabled = false;
                    btnGenerarCuenta.disabled = true;
                } else if (radioNoTieneCuenta.checked) {
                    selectUsuarioOrden.disabled = true;
                    inputsNoTieneCuenta.forEach(input => input.disabled = false);
                    inputsSiTieneCuenta.forEach(input => input.disabled = true);
                    selectsSiTieneCuenta.forEach(input => input.disabled = true);
                    btnSeleccionarCuenta.disabled = true;
                    btnGenerarCuenta.disabled = false;
                }
            }

            // Escuchar cambios en los radios para gestionar el estado de los elementos
            radioTieneCuenta.addEventListener('change', gestionarEstadoElementos);
            radioNoTieneCuenta.addEventListener('change', gestionarEstadoElementos);

            // Llamar a la función inicialmente para establecer el estado inicial
            gestionarEstadoElementos();
        });
    </script>

@endsection
