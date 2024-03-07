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
    </style>
@endsection

@section('content')

    <div class="row mt-5 mb-4 px-2">
        <a href="{{ route('seccion.show', ['slug' => 'catalogo']) }}" class="mt-5 col col-md-2 btn btn-sm btn-dark mr-auto"><i class="fa fa-reply"></i> Regresar</a>
    </div>

    <div class="container-fluid bg-white">
        <div class="row">
            <div class="col-11 mx-auto">
                <div class="row">
                    <div class="col-4 py-5 border">
                        <div class="row">
                            <div class="col">
                                <div class="img-producto" style="
                                    background-image: url('{{ asset('img/productos/'.$producto->portada) }}');
                                "></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center py-3">
                                <input type="text" class="form-control shadow-none fs-3" value="{{ $producto->nombre }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-8 py-5 border">
                        <div class="row">
                            <div class="col">
                                <textarea name="" id="" cols="30" rows="10" class="form-control">{{ $producto->descripcion }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extraJS')
    <script>
        tinymce.init({
            selector: 'textarea',
            // plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            // toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
                    menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount',
                        'advlist autolink lists link image charmap print preview anchor wordcount',

                        'searchreplace visualblocks code fullscreen table visualblocks',
                        'insertdatetime media table contextmenu paste code imagetools',
                        'textcolor colorpicker'
                ],
                // toolbar: 'undo redo | formatselect | ' +
                // 'bold italic backcolor | alignleft aligncenter ' +
                // 'alignright alignjustify | bullist numlist outdent indent | ' +
                // 'removeformat | help',
                    toolbar: 'forecolor backcolor | insert table | undo redo | removeformat styleselect |  bold italic underline |  alignleft aligncenter alignright alignjustify |  bullist numlist | outdent indent | link image | code visualblocks',
                    resize: false,
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
@endsection

