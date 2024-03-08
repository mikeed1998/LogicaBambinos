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
    <style>
        .img-producto {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            width: 100%;
            height: 20rem;
        }

        .card {
            border-radius: 2rem;
        }

        .img-galeria {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            width: 100%;
            height: 16rem;
            border-radius: 2rem;
        }
    </style>
    <style>
        .file-upload input[type="file"], .file-upload2 input[type="file"] {
            position: absolute;
            left: -9999px;
        }

        .file-upload label, .file-upload2 label {
            display: inline-block;
            background-color: #FFFFFF;
            color: #000000;
            font-weight: 700;
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
            background-color: #000000;
            color: #FFFFFF;
            font-weight: 700;
            opacity: 100%;
            transition: all 0.5s;
        }
    </style>
@endsection

@section('content')

    <div class="row mt-5 mb-4 px-2">
        <a href="{{ route('seccion.show', ['slug' => 'catalogo']) }}" class="mt-5 col col-md-2 btn btn-sm btn-dark mr-auto"><i class="fa fa-reply"></i> Regresar</a>
    </div>

    <div class="container-fluid bg-white rounded">
        <div class="row">
            <div class="col-11 mx-auto">
                <div class="row py-2">
                    <div class="col-4">
                        <div class="row">
                            <div class="col position-relative">
                                <div class="img-producto" style="
                                    background-image: url('{{ asset('img/productos/'.$producto->portada) }}');
                                "></div>
                                <div class="col-9 position-absolute bottom-0 start-50 translate-middle">
                                    <form id="form_img_portada" action="cambiar_imagen" method="POST" class="file-upload" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_imagen" value="{{ $producto->id }}">
                                        <input type="hidden" name="tipo_imagen" value="portada_producto">
                                        <input id="img_portada_producto" class="m-0 p-0" type="file" name="archivo">
                                        <label class="col-12 m-0 px-2 d-flex justify-content-center align-items-center" for="img_portada_producto" style=" height: 100%; opacity: 100%; border-radius: 20px;">Actualizar Imagen</label>
                                    </form>
                                    <script>
                                        $('#img_portada_producto').change(function(e) {
                                            $('#form_img_portada').trigger('submit');
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center py-3">
                                <input type="text" class="form-control shadow-none fs-3 editarajax" data-model="Producto" data-field="nombre" data-id="{{$producto->id}}" value="{{ $producto->nombre }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col">
                                <textarea name="" id="" cols="30" rows="10" class="form-control shadow-none editarajax" data-model="Producto" data-field="descripcion" data-id="{{$producto->id}}">{{ $producto->descripcion }}</textarea>
                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col-4">
                                <input type="text" class="form-control shadow-none editarajax" data-model="Producto" data-field="frente" data-id="{{$producto->id}}" value="{{ $producto->frente }}">
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control shadow-none editarajax" data-model="Producto" data-field="fondo" data-id="{{$producto->id}}" value="{{ $producto->fondo }}">
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control shadow-none editarajax" data-model="Producto" data-field="alto" data-id="{{$producto->id}}" value="{{ $producto->alto }}">
                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col-8">
                                <div class="row mt-3">
                                    <div class="slider-caracteristicas">
                                        @for ($i = 0; $i < 10; $i++)
                                            <div class="col">
                                                <input type="text" class="form-control shadow-none editarajax" value="Característica no. {{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-3 text-center">
                                        <a href="#/" class="btn botn-outline" data-bs-toggle="modal" data-bs-target="#caracteristicaModal">
                                            <i class="bi bi-pencil-square fs-1 text-info"></i>
                                        </a>
                                    </div>
                                    <div class="col-3 text-center">
                                        <a href="#/" class="btn botn-outline" data-bs-toggle="modal" data-bs-target="#pagosModal">
                                            <i class="bi bi-coin fs-1 text-success"></i>
                                        </a>
                                    </div>
                                    <div class="col-3 text-center">
                                        <a href="#/" class="btn botn-outline" data-bs-toggle="modal" data-bs-target="#galeriaModal">
                                            <i class="bi bi-camera-fill fs-1 text-black"></i>
                                        </a>
                                    </div>
                                    <div class="col-3 text-center">
                                        <button type="button" class="btn botn-outline" id="btnDesactivar">
                                            <i class="bi bi-trash-fill fs-1 text-danger"></i>
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

    <div class="container-fluid mt-3 py-3 rounded">
        <div class="row">
            <div class="slider-galeria">
                @for ($i = 0; $i < 10; $i++)
                    <div class="col-3 px-2 position-relative">
                        <div class="card">
                            <div class="img-galeria" style="
                                background-image: url('{{ asset('img/productos/'.$producto->portada) }}');
                            "></div>
                        </div>
                        <div class="position-absolute top-0 end-0 translate-middle-x">
                            <button type="button" class="btn btn-outline" id="eliminarGaleria-{{ $i }}">
                                <i class="bi bi-x-circle-fill fs-1 fw-bold" style="color: red;"></i>
                            </button>
                            <script>
                                document.getElementById('eliminarGaleria-{{ $i }}').addEventListener('click', function() {
                                    Swal.fire({
                                        title: "¿Eliminar foto?",
                                        text: "¿Estás seguro de que deseas continuar?",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#d33",
                                        cancelButtonColor: "#3085d6",
                                        confirmButtonText: "Eliminar",
                                        cancelButtonText: "Cancelar"
                                    })
                                    .then((result) => {
                                        if (result.isConfirmed) {
                                            Swal.fire("¡La foto ha sido eliminado!", "", "success");
                                        } else {
                                            // Swal.fire("La eliminación ha sido cancelada.", "", "info");
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="modal fade" id="caracteristicaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="caracteristicaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="caracteristicaModalLabel">Características del producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="producto-caracteristica" class="py-1">Nueva característica</label>
                            <input type="text" class="form-control shadow-none" placeholder="Característica nueva">
                            <button type="submit" class="btn btn-dark w-100 rounded-0 mt-2">Agregar característica</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn w-100 btn-danger rounded-0" data-bs-dismiss="modal">Cerrar ventana</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pagosModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="pagosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="pagosModalLabel">Precios e inventario disponible</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row py-3">
                        <div class="col">
                            <div class="row">
                                <div class="col-6">
                                    <label for="label-precio">Precio</label>
                                    <input type="number" id="label-precio" name="label-precio" step="0.01" class="form-control shadow-none editarajax" placeholder="Ingrese el precio" data-model="Producto" data-field="precio" data-id="{{$producto->id}}" value="{{ $producto->precio }}">
                                </div>
                                <div class="col-6">
                                    <label for="label-stock">Cantidad en inventario</label>
                                    <input type="number" id="label-stock" name="label-stock" class="form-control shadow-none editarajax" placeholder="Inventario disponible" data-model="Producto" data-field="stock" data-id="{{$producto->id}}" value="{{ $producto->stock }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="label-promocion">Promocion (Ejemplos: 15% = 0.15, 100% = 1.00)</label>
                                    <input type="number" id="label-promocion" name="label-promocion" step="0.01" class="form-control shadow-none editarajax" placeholder="Ingrese la promoción" data-model="Producto" data-field="promocion" data-id="{{$producto->id}}" value="{{ $producto->promocion }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn w-100 btn-danger rounded-0" data-bs-dismiss="modal">Cerrar ventana</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="galeriaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="galeriaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="galeriaModalLabel">Agregar imágen a la galeria del producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row py-3">
                        <div class="col">
                            <label for="producto-imagen-galeria">Selecciona una imágen (Formatos admitidos: JPG, PNG, JPEG)</label>
                            <input type="file" id="producto-imagen-galeria" name="producto-imagen-galeria" class="form-control" placeholder="Imágen" accept=".png, .jpg, .jpeg">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn w-100 btn-danger rounded-0" data-bs-dismiss="modal">Cerrar ventana</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extraJS')
    <script>
        // tinymce.init({
        //     selector: 'textarea',
        //             menubar: false,
        //         plugins: [
        //             'advlist autolink lists link image charmap print preview anchor',
        //             'searchreplace visualblocks code fullscreen',
        //             'insertdatetime media table paste code help wordcount',
        //                 'advlist autolink lists link image charmap print preview anchor wordcount',

        //                 'searchreplace visualblocks code fullscreen table visualblocks',
        //                 'insertdatetime media table contextmenu paste code imagetools',
        //                 'textcolor colorpicker'
        //         ],
        //             toolbar: 'forecolor backcolor | insert table | undo redo | removeformat styleselect |  bold italic underline |  alignleft aligncenter alignright alignjustify |  bullist numlist | outdent indent | link image | code visualblocks',
        //             resize: false,
        //         content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        // });
    </script>
    <script>
        $('.slider-galeria').slick({
            infinite: true,
            autoplay: true,
            dots: false,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 1
        });
    </script>
    <script>
        $('.slider-caracteristicas').slick({
            infinite: true,
            autoplay: true,
            dots: false,
            arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1
        });
    </script>

    <script>
        document.getElementById('btnDesactivar').addEventListener('click', function() {
            // Muestra una confirmación con SweetAlert
            Swal.fire({
                title: "¿Eliminar producto?",
                text: "Esta acción desactivará el producto de la tienda. ¿Estás seguro de que deseas continuar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Eliminar",
                cancelButtonText: "Cancelar"
            })
            .then((result) => {
                if (result.isConfirmed) {
                    // Aquí puedes colocar la lógica para eliminar el elemento
                    // Puedes utilizar AJAX u otras técnicas según tu aplicación
                    Swal.fire("¡El producto ha sido eliminado!", "", "success");
                } else {
                    Swal.fire("La eliminación ha sido cancelada.", "", "info");
                }
            });
        });
    </script>
@endsection



