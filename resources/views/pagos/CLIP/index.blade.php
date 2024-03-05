<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Pagos</title>
    <style>

        :root {
            --morado-fondo: #3D375C;
            --morado-link_hover: #7228A5;
            --blanco: #FFFFFF;
            --negro: #000000;
        }

        body {
            background-color: var(--morado-fondo);
        }

        header {
            display: none;
        }

		.imagen-clip {
			position: relative;
		}

		.imagen-hover {
			position: absolute;
			top: 0;
			left: 0;
			opacity: 0;
			transition: opacity 0.3s ease-in-out;
		}

		.imagen-clip:hover .imagen-hover {
			opacity: 1;
			filter: brightness(90%); /* Oscurecer la imagen al 80% */
		}

		#clipCheckoutButton {
            visibility: hidden;
        }



    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col">
                <div class="row py-5">
                    <div class="col text-start">
                        <a href="{{ route('cart.datosEnvio') }}" class="fs-5 btn btn-danger">Cancelar pago y volver</a>
                    </div>
                </div>
                <div class="card rounded p-2">
                    <div class="row mt-5">
                        <div class="col-md-6 col-12">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-dark table-hover table-striped-columns">
                                        <tr>
                                            <th class="fs-5">Dato</th>
                                            <td class="fs-5">Cálculo (MXN)</td>
                                        </tr>
                                        <tr>
                                            <th>Subtotal producto(s)</th>
                                            <td>${{ $totalCompra }}</td>
                                        </tr>
                                        <tr>
                                            <th>IVA (16%)</th>
                                            <td>${{ $iva }}</td>
                                        </tr>
                                        <tr>
                                            <th>Costo de envío</th>
                                            <td>${{ $envio }}</td>
                                        </tr>
                                        <tr>
                                            <th>TOTAL</th>
                                            <td>${{ $totalGRNL }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="row">
                                <div class="col text-center fs-4 fw-bolder">
                                    Proceder con el pago
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mx-auto">
                                    <button id="primerBoton" class="btn btn-outline">
                                        <div class="imagen-clip">
                                            <img src="{{ asset('img/clip/clip_basic.png') }}" alt="Clip básica" class="img-fluid">
                                            <img src="{{ asset('img/clip/clip_hover.png') }}" alt="Clip al pasar el ratón" class="imagen-hover img-fluid">
                                        </div>
                                    </button>
                                    <button id="clipCheckoutButton" class="clipCheckoutButton"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<script>
		document.getElementById('primerBoton').addEventListener('click', function() {
			// Simula el clic en el segundo botón
			document.getElementById('clipCheckoutButton').click();
		});
	</script>

    <script
        id="checkoutClipPlugin"
        payment_request_id="{{ $paymentRequestId }}"
        type="module"
        src="https://sdk.clip.mx/js/v1/checkout.js">
    </script>
    <script>
        document.getElementsByTagName("h1")[0].style.fontSize = "2.5vw";
        document.getElementsByTagName("p")[0].style.fontSize = "2.5vw";
    </script>
    <script>
        const checkoutButton = document.querySelector('.clipCheckoutButton');
        checkoutButton.addEventListener('payment_status_change', (event) => {
          const paymentStatus = event.detail.paymentStatus;

          if (paymentStatus === 'APPROVED') {
            // Pago exitoso, mostrar mensaje de confirmación
            console.log("Transacción finalizada con exito");
            alert('Pago exitoso!');
            // Redirect to payment success page after a short delay
            setTimeout(() => {
              window.location.href = "{{ route('user.home') }}";
            }, 2000); // Adjust delay as needed (in milliseconds)
          } else if (paymentStatus === 'DECLINED') {
            // Pago fallido, mostrar mensaje de error
            console.log("La transaccion ha fallado");
            alert('El pago ha sido rechazado.');
          }
        });
    </script>
</body>
</html>
