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

    <div class="container-fluid bg-white mb-5 pb-5">
        <div class="row">
            <div class="col-9 mx-auto">
                <form action="{{ route('productos.store') }}" id="miFormulario" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col text-center fs-5 py-4">General</div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6 py-1">
                            <label for="nombre">Nombre del producto</label>
                            <input required type="text" id="nombre" name="nombre" class="form-control shadow-none">
                        </div>
                        <div class="col-6 py-1">
                            <label for="categoria">Categoría del producto</label>
                            <select required name="categoria" id="categoria" class="form-select text-dark">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col py-1">
                            <label for="descripcion">Descripción del producto</label>
                            <textarea required name="descripcion" id="descripcion" cols="30" rows="10" class="form-control shadow-none"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col py-1">
                            <label for="portada" class="py-2">Portada del producto</label>
                            <input required type="file" id="portada" name="portada" class="form-control shadow-none" accept=".png, .jpg, .jpeg">
                        </div>
                    </div>
                    <div class="row py-4 form-group">
                        <div class="col-12 text-center fs-5">Medidas</div>
                        <div class="col-4 py-1">
                            <label for="frente">Frente</label>
                            <input required type="text" id="frente" name="frente" class="form-control shadow-none">
                        </div>
                        <div class="col-4 py-1">
                            <label for="fondo">Fondo</label>
                            <input required type="text" id="fondo" name="fondo" class="form-control shadow-none">
                        </div>
                        <div class="col-4 py-1">
                            <label for="alto">Alto</label>
                            <input required type="text" id="alto" name="alto" class="form-control shadow-none">
                        </div>
                        <div class="col-4 py-1">
                            <label for="precio">Precio</label>
                            <input required type="text" id="precio" name="precio" class="form-control shadow-none">
                        </div>
                        <div class="col-4 py-1">
                            <label for="stock">Cantidad en inventario</label>
                            <input required type="text" id="stock" name="stock" class="form-control shadow-none">
                        </div>
                        <div class="col-4 py-1">
                            <label for="alto">Promoción (Opcional) (ej. 15% = 0.15)</label>
                            <input required type="text" id="alto" name="alto" class="form-control shadow-none">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center fs-5 py-4">Características</div>
                    </div>
                    <div class="row py-2 form-group" id="contenedorInputs">
                        <div class="col-12 py-2">
                            <input required type="text" name="caracteristica[]" class="form-control shadow-none">
                            <button type="button" class="btn btn-danger w-100 btn-sm ml-2 rounded-0" style="display: none;" onclick="eliminarInput(this)">Eliminar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-success w-100 text-center" onclick="agregarInput()">Agregar otra característica</button>
                        </div>
                    </div>
                    <div class="row py-4 form-group">
                        <div class="col">
                            <button type="submit" class="btn btn-dark w-100 rounded-0">Finalizar y crear nuevo producto</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('extraJS')
    <script>
        function agregarInput() {
            var contenedorInputs = document.getElementById('contenedorInputs');
            var nuevoInput = document.querySelector('#contenedorInputs .col-12').cloneNode(true);
            nuevoInput.querySelector('input').value = '';
            contenedorInputs.appendChild(nuevoInput);

            // Mostrar el botón "Eliminar" solo para los inputs adicionales
            var botonesEliminar = document.querySelectorAll('#contenedorInputs .btn-danger');
            botonesEliminar.forEach(function (boton, index) {
                boton.style.display = (index === 0) ? 'none' : 'block';
            });
        }

        function eliminarInput(btn) {
            var contenedorInputs = document.getElementById('contenedorInputs');
            var inputAEliminar = btn.parentNode;

            // Verificar si hay más de un input antes de permitir la eliminación
            if (contenedorInputs.childElementCount > 1) {
                contenedorInputs.removeChild(inputAEliminar);
            }

            // Mostrar el botón "Eliminar" solo para los inputs adicionales
            var botonesEliminar = document.querySelectorAll('#contenedorInputs .btn-danger');
            botonesEliminar.forEach(function (boton, index) {
                boton.style.display = (index === 0) ? 'none' : 'block';
            });
        }
    </script>
@endsection


