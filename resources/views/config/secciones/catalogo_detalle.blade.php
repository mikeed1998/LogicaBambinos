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
                    <div class="col-8">
                        <div class="row">
                            <div class="col">
                                <textarea name="" id="" cols="30" rows="10" class="form-control">{{ $producto->descripcion }}</textarea>
                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col-4">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col-8">
                                <div class="row mt-3">
                                    <div class="slider-caracteristicas">
                                        @for ($i = 0; $i < 10; $i++)
                                            <div class="col">
                                                <input type="text" class="form-control" value="Característica no. {{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-3 text-center">
                                        <a href="#/" class="btn botn-outline">
                                            <i class="bi bi-pencil-square fs-1 text-info"></i>
                                        </a>
                                    </div>
                                    <div class="col-3 text-center">
                                        <a href="#/" class="btn botn-outline">
                                            <i class="bi bi-coin fs-1 text-success"></i>
                                        </a>
                                    </div>
                                    <div class="col-3 text-center">
                                        <a href="#/" class="btn botn-outline">
                                            <i class="bi bi-camera-fill fs-1 text-black"></i>
                                        </a>
                                    </div>
                                    <div class="col-3 text-center">
                                        <a href="#/" class="btn botn-outline">
                                            <i class="bi bi-trash-fill fs-1 text-danger"></i>
                                        </a>
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
                            <button type="" class="btn btn-outline">
                                <i class="bi bi-x-circle-fill fs-1 fw-bold" style="color: red;"></i>
                            </button>
                        </div>
                    </div>
                @endfor
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
@endsection



