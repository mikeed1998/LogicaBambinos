@extends('layouts.app')

@section('content')
    <style>
        @media(min-width: 1800px) {
            .carta-blanca {
                border-top-left-radius: 2rem;
                border-bottom-left-radius: 2rem;
            }

            .carta-negra {
                border-top-right-radius: 2rem;
                border-bottom-right-radius: 2rem;
            }
        }

        @media(min-width: 1400px) and (max-width: 1799px) {
            .carta-blanca {
                border-top-left-radius: 2rem;
                border-bottom-left-radius: 2rem;
            }

            .carta-negra {
                border-top-right-radius: 2rem;
                border-bottom-right-radius: 2rem;
            }
        }

        @media(min-width: 1200px) and (max-width: 1399px) {
            .carta-blanca {
                border-top-left-radius: 2rem;
                border-bottom-left-radius: 2rem;
            }

            .carta-negra {
                border-top-right-radius: 2rem;
                border-bottom-right-radius: 2rem;
            }
        }

        @media(min-width: 992px) and (max-width: 1199px) {
            .carta-blanca {
                border-top-left-radius: 2rem;
                border-bottom-left-radius: 2rem;
            }

            .carta-negra {
                border-top-right-radius: 2rem;
                border-bottom-right-radius: 2rem;
            }
        }

        @media(min-width: 768px) and (max-width: 991px) {
            .carta-blanca {
                border-top-left-radius: 2rem;
                border-bottom-left-radius: 2rem;
            }

            .carta-negra {
                border-top-right-radius: 2rem;
                border-bottom-right-radius: 2rem;
            }
        }

        @media(min-width: 576px) and (max-width: 767px) {
            .carta-blanca {
                border-top-left-radius: 2rem;
                border-top-right-radius: 2rem;
            }

            .carta-negra {
                border-bottom-left-radius: 2rem;
                border-bottom-right-radius: 2rem;
            }
        }

        @media(min-width: 480px) and (max-width: 575px) {
            .carta-blanca {
                border-radius: 0;
            }

            .carta-negra {
                border-radius: 0;
            }
        }

        @media(min-width: 320px) and (max-width: 479px) {
            .carta-blanca {
                border-radius: 0;
            }

            .carta-negra {
                border-radius: 0;
            }
        }

        @media(min-width: 0px) and (max-width: 319px) {
            .carta-blanca {
                border-radius: 0;
            }

            .carta-negra {
                border-radius: 0;
            }
        }


    </style>

    <div class="container">
        <div class="row mt-2">
            <div class="col text-center">
                <h3>Revise que todos los datos sean correctos</h3>
                {{-- <a href="{{ route('clip.index') }}" class="btn btn-success">Proceder con el pago</a> --}}
                <div class="row mt-5">
                    <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12 bg-white text-dark shadow carta-blanca">
                        <div class="row mt-5 pt-5 mb-5">
                            <div class="col-12 mt-5 pt-5">
                                <i class="bi bi-person-lock display-5"></i>
                            </div>
                            <div class="col-12 fs-3">
                                Datos personales
                            </div>
                        </div>
                        <div class="row mb-5 pb-5">
                            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-11 col-sm-11 col-12 mx-auto">
                                <div class="row form-group">
                                    <div class="col text-start">
                                        <label for="nombre" class="form-control-label">Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control shadow-none editarajax" value="{{ $usuario->name }}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col text-start">
                                        <label for="email" class="form-control-label">Email</label>
                                        <input readonly type="text" name="email" id="email" class="form-control shadow-none" value="{{ $usuario->email }}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col text-start">
                                        <label for="telefono" class="form-control-label">Telefono (10 digitos)</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control shadow-none">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col text-start">
                                        <label for="rfc" class="form-control-label">RFC</label>
                                        <input type="text" name="rfc" id="rfc" class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-6 col-sm-12 col-12 bg-dark text-white shadow carta-negra">
                        <div class="row mt-5">
                            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-11 col-sm-11 col-12 mx-auto mt-5">
                                <div class="row mb-5">
                                    <div class="col-12">
                                        <i class="bi bi-send-fill display-5"></i>
                                    </div>
                                    <div class="col-12 fs-3">
                                        Datos de envió
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="row mt-2">
                                            <div class="col text-start">
                                                <label for="calle" class="form-control-label">Calle</label>
                                                <input type="text" name="calle" id="calle" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col text-start">
                                                <label for="numero_interior" class="form-control-label">Número Interior (Opcional)</label>
                                                <input type="text" name="numero_interior" id="numero_interior" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col text-start">
                                                <label for="estado" class="form-control-label">Estado</label>
                                                <input type="text" name="estado" id="estado" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col text-start">
                                                <label for="colonia" class="form-control-label">Colonia</label>
                                                <input type="text" name="colonia" id="colonia" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="row mt-2">
                                            <div class="col text-start">
                                                <label for="numero_exterior" class="form-control-label">Número Exterior</label>
                                                <input type="text" name="numero_exterior" id="numero_exterior" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col text-start">
                                                <label for="pais" class="form-control-label">País</label>
                                                <input type="text" name="pais" id="pais" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col text-start">
                                                <label for="municipio" class="form-control-label">Municipio</label>
                                                <input type="text" name="municipio" id="municipio" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col text-start">
                                                <label for="codigo_postal" class="form-control-label">Código Postal</label>
                                                <input type="text" name="codigo_postal" id="codigo_postal" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5 mb-5">
                                    <div class="col-12 mx-auto">
                                        <a href="{{ route('clip.index') }}" class="btn py-2 fs-5 btn-success">Confirmar mis datos y poceder con el pago</a>
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
@section('scripts')

    {{-- {!! Toastr::message() !!} --}}

@endsection
