@extends('layouts.app')

@section('content')
    <style>
        .carta-producto {
            border-top-left-radius: 2rem;
            border-top-right-radius: 2rem;
        }

        .imagen-producto {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            border-top-left-radius: 2rem;
            border-top-right-radius: 2rem;
            width: 100%;
            height: 20rem;
        }

        @media(min-width: 1800px) {
            .carta-tabla {
                border-radius: 2rem;
            }
        }

        @media(min-width: 1400px) and (max-width: 1799px) {
            .carta-tabla {
                border-radius: 2rem;
            }
        }

        @media(min-width: 1200px) and (max-width: 1399px) {
            .carta-tabla {
                border-radius: 2rem;
            }
        }

        @media(min-width: 992px) and (max-width: 1199px) {
            .carta-tabla {
                border-radius: 2rem;
            }
        }

        @media(min-width: 768px) and (max-width: 991px) {
            .carta-tabla {
                border-radius: 2rem;
            }
        }

        @media(min-width: 576px) and (max-width: 767px) {
            .carta-tabla {
                border-radius: 0;
            }
        }

        @media(min-width: 480px) and (max-width: 575px) {
            .carta-tabla {
                border-radius: 0;
            }
        }

        @media(min-width: 320px) and (max-width: 479px) {
            .carta-tabla {
                border-radius: 0;
            }
        }

        @media(min-width: 0px) and (max-width: 319px) {
            .carta-tabla {
                border-radius: 0;
            }
        }

    </style>

    <div class="container-fluid z-0 mb-5">
        <div class="row">
            <div class="col-md-8 col-12 mx-auto">
                <div class="card carta-tabla px-0 border-0 shadow">
                    <div class="row">
                        <div class="col-9 py-5 mx-auto">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>PRODUCTO</th>
                                        <th>CANTIDAD</th>
                                        <th>PRECIO</th>
                                        <th>PRECIO FINAL</th>
                                        <th>SUBTOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @if(session('cart'))
                                        @foreach(session('cart') as $id => $details)
                                            @php
                                                $total += $details['price'] * $details['quantity']
                                            @endphp
                                            <tr data-id="{{ $id }}">
                                                <td>
                                                    <button class="btn btn-danger btn-sm cart_remove rounded-circle"><i class="bi bi-trash"></i></button></td>
                                                </td>
                                                <td>
                                                    <p>{{ $details['product_name'] }} </p>
                                                </td>
                                                <td>
                                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" data-row-id="{{ $id }}" min="0" />
                                                </td>
                                                <td>${{ $details['price'] }}</td>
                                                <td>${{ $details['price'] }}</td>
                                                <td>
                                                    <span id="subtotal_{{ $id }}" data-subtotal="{{ $details['price'] * $details['quantity'] }}">
                                                        ${{ $details['price'] * $details['quantity'] }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <tr>
                                        <td colspan="6" class="text-end"><h3 class="fs-5"><p>Total <strong id="cartTotal">${{ $total }}</strong></p></h3></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-8 col-11 mx-auto">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <a href="{{ route('front.productos') }}" class="btn w-100 py-2 fs-5 btn-white border"><i class=""></i>Volver a la tienda</a>
                            </div>
                            <div class="col-md-4 col-12">
                                <a href="javascript:void(0)" id="clearCartBtn" class="btn w-100 py-2 fs-5 btn-white border"><i class="bi bi-trash"></i> Vaciar carrito</a>
                            </div>
                            <div class="col-md-4 col-12">
                                <a href="{{ route('cart.datosEnvio') }}" class="btn w-100 py-2 fs-5 btn-dark" id="checkoutBtn">Continuar<i class=""></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 col-12 text-center mx-auto fs-1 py-3">
                    Tus productos
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 col-11 mx-auto">
                    <div class="row d-flex justify-content-center align-items-center">
                        @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                                <div class="col-md-3 col-12">
                                    <div class="card carta-producto">
                                        <div class="imagen-producto" style="
                                            background-image: url('{{ asset('img/productos/20231229160623.png') }}');
                                        "></div>
                                        <div class="card-body">
                                            {{ $details['product_name'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        @if(session('error'))
            toastr.error('{{ session('error') }}');
        @endif
    </script>
    <script type="text/javascript">
        $(".cart_update").change(function (e) {
            e.preventDefault();

            var ele = $(this);
            var rowId = ele.data("row-id");
            var quantity = ele.val();

            if (quantity == 0) {
                // Si la cantidad es 0, solicitar confirmación antes de eliminar el producto
                Swal.fire({
                    title: '¿Deseas quitar este producto del carrito?',
                    text: 'Esta acción no se puede deshacer',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, quitarlo'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Llamar a la función para eliminar el producto
                        removeProduct(rowId);
                        location.reload();
                    } else {
                        // Restaurar la cantidad a 1 si el usuario cancela
                        ele.val(1);
                    }
                });
            } else {
                // Si la cantidad no es 0, realizar la actualización normalmente
                updateCart(rowId, quantity);
            }
        });

        // Función para actualizar el carrito
        function updateCart(rowId, quantity) {
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: rowId,
                    quantity: quantity
                },
                success: function (response) {
                    // Actualizar la subtotal directamente
                    var formattedSubtotal = '$' + parseFloat(response.subtotal).toFixed(2);
                    $('#subtotal_' + rowId).text(formattedSubtotal);
                    // Mostrar notificación Toastr en éxito
                    toastr.success('Carrito actualizado correctamente!', 'Éxito');
                    // Llamar a la función para actualizar el total
                    updateTotal(response.total);
                },
                error: function (xhr, status, error) {
                    // Mostrar notificación Toastr en error de la solicitud AJAX
                    toastr.error('Se produjo un error al procesar su solicitud.', 'Error');
                    console.error(xhr.responseText);
                }
            });

            $(document).trigger('cartUpdated');
        }

        // Función para eliminar el producto del carrito
        function removeProduct(rowId) {
            $.ajax({
                url: '{{ route('cart.remove') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: rowId
                },
                success: function (response) {
                    // Eliminar la fila de la tabla directamente
                    var removedRow = $('#subtotal_' + rowId).parents("tr");
                    removedRow.remove();
                    // Obtener el subtotal del producto eliminado directamente desde el atributo data-subtotal
                    var subtotalRemoved = parseFloat($('#subtotal_' + rowId).data('subtotal')) || 0;
                    // Verificar que el total actual sea un número
                    var currentTotal = parseFloat($('#cartTotal').text().replace('$', '')) || 0;
                    // Calcular el nuevo total restando el subtotal del producto eliminado
                    var newTotal = currentTotal - subtotalRemoved;
                    console.log('Subtotal Removed:', subtotalRemoved);
                    console.log('Current Total:', currentTotal);
                    console.log('New Total:', newTotal);
                    // Actualizar el total en la vista
                    updateTotal(newTotal);
                    // Mostrar notificación Toastr en éxito
                    toastr.success('¡El producto ha sido eliminado del carrito!', 'Éxito');
                },
                error: function (xhr, status, error) {
                    // Mostrar notificación Toastr en error de la solicitud AJAX
                    toastr.error('Hubo un problema al eliminar.', 'Error');
                    console.error(xhr.responseText);
                }
            });

            $(document).trigger('cartUpdated');
        }

        // Función para actualizar el total
        function updateTotal(newTotal) {
            // Actualiza el total en la vista
            $('#cartTotal').text('$' + parseFloat(newTotal).toFixed(2));
            console.log('Total updated:', newTotal);
        }

        $(".cart_remove").click(function (e) {
            e.preventDefault();

            var ele = $(this);
            var rowId = ele.parents("tr").attr("data-id");

            // Utiliza SweetAlert en lugar de confirm
            Swal.fire({
                title: '¿Deseas quitar este producto del carrito?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, quitarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('cart.remove') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: rowId
                        },
                        success: function (response) {
                            // Remueve la fila de la tabla directamente
                            ele.parents("tr").remove();
                            // Obtiene el subtotal del producto eliminado y verifica que sea un número
                            var subtotalRemoved = parseFloat($('#subtotal_' + rowId).text().replace('$', '')) || 0;
                            // Verifica que el total actual sea un número
                            var currentTotal = parseFloat($('#cartTotal').text().replace('$', '')) || 0;
                            // Calcula el nuevo total restando el subtotal del producto eliminado
                            var newTotal = currentTotal - subtotalRemoved;
                            console.log('New Total:', newTotal);
                            // Actualiza el total en la vista
                            updateTotal(newTotal);
                            // Muestra notificación Toastr en éxito
                            toastr.success('El producto ha sido vaciado del carrito!', 'Success');
                            // Recarga la página después de eliminar el producto
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            // Muestra notificación Toastr en error de la solicitud AJAX
                            toastr.error('Hubo un problema para eliminar.', 'Error');
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
            $(document).trigger('cartUpdated');
        });

        $("#clearCartBtn").click(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, vaciar carrito!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('cart.clear') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function (response) {
                            // Actualizar la UI según sea necesario, por ejemplo, limpiar la tabla del carrito y actualizar el total a $0
                            toastr.success(response.message, 'Success');
                            location.reload(); // O actualizar la vista del carrito dinámicamente sin recargar
                        },
                        error: function (xhr, status, error) {
                            toastr.error('Hubo un problema al vaciar el carrito.', 'Error');
                        }
                    });
                }
            });
        });

    </script>
@endsection
