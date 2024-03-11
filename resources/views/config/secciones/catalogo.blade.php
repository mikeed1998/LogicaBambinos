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

        .img-catalogo {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            width: 100%;
            height: 9rem;
        }
    </style>
    <style>
        .switch-color-inicio {
            box-shadow: none;
            background-color: #FFFFFF;
            border: 1px solid #000000;
        }

        .switch-color-inicio:checked {
            background-color: #000000;
        }

        .switch-color-ocultar {
            box-shadow: none;
            background-color: #FFFFFF;
            border: 1px solid #000000;
        }

        .switch-color-ocultar:checked {
            background-color: #AAAAAA;
        }

        .switch-color-eliminar {
            box-shadow: none;
            background-color: #FFFFFF;
            border: 1px solid #000000;
        }

        .switch-color-eliminar:checked {
            background-color: #FF4136;
        }
    </style>
@endsection

@section('content')

    <div class="row mt-5 mb-4 px-2">
        <a href="{{ route('front.admin') }}" class="mt-5 col col-md-2 btn btn-sm btn-dark mr-auto"><i class="fa fa-reply"></i> Regresar</a>
    </div>

    <div class="container-fluid">
        <div class="row py-3">
            <div class="col mx-auto text-center fs-1">
                Catálogo de productos
            </div>
        </div>
        <div class="row py-3">
            <div class="col text-center mx-auto">
                <a href="{{ route('productos.create') }}" class="btn btn-dark rounded-0">
                    Agregar nuevo producto
                </a>
            </div>
        </div>
        <div class="row py-3">
            <div class="col">
                <input class="form-control shadow-none" id="filtro_palabras" type="text" placeholder="Filtrar por nombre">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row" id="filtro">
                    @foreach($productos as $producto)
                        <div class="col-xxl-12 col-xl-12 col-lg-5 col-md-9 col-sm-12 col-12 mx-auto mt-md-0 mt-5 columna">
                            <div class="row px-0 border bg-white">
                                <div class="col-xxl-2 col-xl-2 col-lg-12 col-md-12 col-sm-12 col-12 px-0">
                                    <div class="img-catalogo" style="
                                        background-image: url('{{ asset('img/productos/'.$producto->portada) }}');
                                    "></div>
                                </div>
                                <div class="col-xxl-6 col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="row align-items-center justify-content-center h-100">
                                        <div class="col-md-10 col-12 mx-auto fs-1 py-md-0 py-3">
                                            {{ $producto->nombre }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-3 col-xl-4 col-lg-12 col-md-9 col-sm-12 col-12 text-center">

                                    <div class="form-check form-switch ms-5">
                                        <label for="switch_inicio-{{$producto->id}}" class="form-control-label fw-bolder py-2">Mostrar en inicio</label>
                                        <input class="form-check-input switch-color-inicio shadow-none fs-2" role="switch" id="switch_inicio-{{$producto->id}}" data-id="{{$producto->id}}" data-campo="inicio" type="checkbox" @if($producto->inicio == 1) checked @endif>
                                    </div>
                                    <script>
                                        $('#switch_inicio-'+{{$producto->id}}).change(function (e){
                                            var checkbox = $(this);
                                            console.log('switch-'+{{$producto->id}});
                                            var check = 0;
                                            if (checkbox.prop('checked')) {
                                                check = 1;
                                            } else {
                                                check = 2;
                                            }
                                            console.log(check);
                                            var id = checkbox.attr("data-id");
                                            var tcsrf = $('meta[name="csrf-token"]').attr('content');
                                            var valor = check;
                                            var URL = "{{ route('ajax.switch_inicio') }}";
                                            console.log("valor: " + valor);
                                            $.ajax({
                                                url: URL,
                                                type: 'post',
                                                dataType: 'json',
                                                data: {
                                                    "_method": 'post',
                                                    "_token": tcsrf,
                                                    "id": id,
                                                    "valor": valor
                                                }
                                            })
                                            .done(function(msg) {
                                                console.log(msg);
                                                if (msg.success) {
                                                    toastr["info"](msg.mensaje);
                                                    if (msg.mensaje.valor == 1) {
                                                        checkbox.prop('checked', true);
                                                    } else if (msg.mensaje.valor == 2) {
                                                        checkbox.prop('checked', false);
                                                    }
                                                } else {
                                                    toastr["error"](msg.mensaje);
                                                }
                                            })
                                            .fail(function(msg) {
                                                toastr["error"]('Error al agregar el producto al inicio');
                                            });
                                        });
                                    </script>
                                    <div class="form-check form-switch ms-5">
                                        <label for="switch_ocultar-{{$producto->id}}" class="form-control-label fw-bolder py-2">Ocultar de la tienda</label>
                                        <input class="form-check-input switch-color-ocultar shadow-none fs-2" role="switch" id="switch_ocultar-{{$producto->id}}" data-id="{{$producto->id}}" data-campo="visible" type="checkbox" @if($producto->visible == 1) checked @endif>
                                    </div>
                                    <script>
                                        $('#switch_ocultar-'+{{$producto->id}}).change(function (e){
                                            var checkbox = $(this);
                                            console.log('switch-'+{{$producto->id}});
                                            var check = 0;
                                            if (checkbox.prop('checked')) {
                                                check = 1;
                                            } else {
                                                check = 2;
                                            }
                                            console.log(check);
                                            var id = checkbox.attr("data-id");
                                            var tcsrf = $('meta[name="csrf-token"]').attr('content');
                                            var valor = check;
                                            var URL = "{{ route('ajax.switch_ocultar') }}";
                                            console.log("valor: " + valor);
                                            $.ajax({
                                                url: URL,
                                                type: 'post',
                                                dataType: 'json',
                                                data: {
                                                    "_method": 'post',
                                                    "_token": tcsrf,
                                                    "id": id,
                                                    "valor": valor
                                                }
                                            })
                                            .done(function(msg) {
                                                console.log(msg);
                                                if (msg.success) {
                                                    toastr["info"](msg.mensaje);
                                                    if (msg.mensaje.valor == 1) {
                                                        checkbox.prop('checked', true);
                                                    } else if (msg.mensaje.valor == 2) {
                                                        checkbox.prop('checked', false);
                                                    }
                                                } else {
                                                    toastr["error"](msg.mensaje);
                                                }
                                            })
                                            .fail(function(msg) {
                                                toastr["error"]('Error al agregar el producto al inicio');
                                            });
                                        });
                                    </script>
                                    <div class="form-check form-switch ms-5">
                                        <label for="switch_eliminar-{{$producto->id}}" class="form-control-label fw-bolder py-2">Eliminar de la tienda</label>
                                        <input class="form-check-input switch-color-eliminar shadow-none fs-2" role="switch" id="switch_eliminar-{{$producto->id}}" data-id="{{$producto->id}}" data-campo="activo" type="checkbox" @if($producto->activo == 1) checked @endif>
                                    </div>
                                    <script>
                                        $('#switch_eliminar-'+{{$producto->id}}).change(function (e){
                                            var checkbox = $(this);
                                            console.log('switch-'+{{$producto->id}});
                                            var check = checkbox.prop('checked') ? 1 : 2;
                                            console.log(check);
                                            var id = checkbox.attr("data-id");

                                            Swal.fire({
                                                title:
                                                    (check == 1) ?
                                                        "¿Deseas habilitar el producto?"
                                                    :
                                                        "¿Deseas deshabilitar el producto?",
                                                text:
                                                    (check == 1) ?
                                                        "El producto volverá a estar disponible en la tienda."
                                                    :
                                                        "Esta acción eliminará parcialmente el producto. Los usuarios cuyos carritos hayan guardado este producto lo perderán, esta acción se puede revertir en el futuro",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#d33",
                                                cancelButtonColor: "#3085d6",
                                                confirmButtonText: "Aceptar"
                                            })
                                            .then((result) => {
                                                if (result.isConfirmed) {
                                                    var tcsrf = $('meta[name="csrf-token"]').attr('content');
                                                    var valor = check;
                                                    var URL = "{{ route('ajax.switch_eliminar') }}";
                                                    console.log("valor: " + valor);
                                                    $.ajax({
                                                        url: URL,
                                                        type: 'post',
                                                        dataType: 'json',
                                                        data: {
                                                            "_method": 'post',
                                                            "_token": tcsrf,
                                                            "id": id,
                                                            "valor": valor
                                                        }
                                                    })
                                                    .done(function(msg) {
                                                        console.log(msg);
                                                        if (msg.success) {
                                                            toastr["info"](msg.mensaje);
                                                            if (msg.mensaje.valor == 1) {
                                                                checkbox.prop('checked', true);
                                                            } else if (msg.mensaje.valor == 2) {
                                                                checkbox.prop('checked', false);
                                                            }
                                                        } else {
                                                            toastr["error"](msg.mensaje);
                                                        }
                                                    })
                                                    .fail(function(msg) {
                                                        toastr["error"]('Error al agregar el producto al inicio');
                                                    });
                                                } else {
                                                    checkbox.prop('checked', !checkbox.prop('checked'));
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                                <div class="col-xxl-1 col-xl-1 col-lg-12 col-md-12 col-sm-12 col-12 text-center py-md-0 py-3">
                                    <div class="row align-items-center justify-content-center h-100">
                                        <a href="{{ route('productos.show', ['producto' => $producto->id]) }}" class="btn">
                                            <div class="col">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#dc3545" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



@endsection

@section('extraJS')
    <script>
        $(document).ready(function(){
            $("#filtro_palabras").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#filtro .columna").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection

