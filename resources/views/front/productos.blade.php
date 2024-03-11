@extends('layouts.app')

@section('titulo', 'Productos')

@section('content')

    <div class="container py-5 z-0">
        <div class="row">
            @foreach($productos as $product)
                <div class="col-xs-18 col-sm-6 col-md-4">
                    <div class="img_thumbnail productlist">
                        <img src="{{ asset('img/productos/'.$product->portada) }}" class="img-fluid">
                        <div class="caption">
                            <h4>{{ $product->nombre }}</h4>
                            <p>{{ $product->descripcion }}</p>
                            <p><strong>Precio: </strong> ${{ $product->precio }}</p>
                            <p class="btn-holder">
                                <a href="#" class="btn btn-primary btn-block text-center btn-add-to-cart" role="button" data-product-id="{{ $product->id }}">
                                    Agregar al carrito
                                </a>
                            </p>
                            <p>
                                @foreach ($producto_caracteristicas as $pc)
                                    @if ($pc->producto == $product->id)
                                        <div>{{ $pc->caracteristica }}</div>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('scripts')
<script>
    // Mueve la función updateCartCount fuera del $(document).ready
    function updateCartCount(count) {
        console.log('Updating cart count to:', count);
        $('.cart-count').text(count);
    }

    // Mantén el resto del script como está
    $(".btn-add-to-cart").click(function (e) {
        e.preventDefault();

        var productId = $(this).data('product-id');

        $.ajax({
            url: 'add-to-cart/' + productId,
            method: "GET",
            success: function (response) {
                if (response.success) {
                    // Actualizar el contador del carrito
                    updateCartCount(response.cart_count);

                    // Actualizar el contador del carrito en el menú (agregando esto)
                    $('.badge-danger').text(response.cart_count);

                    // Mostrar notificación Toastr de éxito
                    toastr.success(response.message);
                } else {
                    // Mostrar notificación Toastr de error
                    toastr.error('Error adding product to cart.');
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>
@endsection
