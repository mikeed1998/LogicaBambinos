@extends('layouts.app')

@section('content')
    <style>
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
    {{-- @include('layouts.partials.header') --}}

    <div class="container-fluid">
        <div class="row">
			<div class="col text-start">
				<a href="{{ route('cart.datosEnvio') }}" class="fs-5 btn btn-danger">Cancelar pago y volver</a>
			</div>
		</div>
		<div class="row">
			<div class="col">

			</div>
		</div>
        <div class="row">
            <div class="col">
				<div class="row">
					<div class="col">
						<h1>Confirmación de pago</h1>
						<p>Total a pagar: ${{ $totalCompra }}</p>
						<p> Aceptamos pagos con <b>Clip</b> </p>
					</div>
				</div>
                <div class="row">
					<div class="col-6 mx-auto">
						<button id="primerBoton" class="btn btn-outline">
							<div class="imagen-clip">
								<img src="{{ asset('img/clip/clip_basic.png') }}" alt="Clip básica">
								<img src="{{ asset('img/clip/clip_hover.png') }}" alt="Clip al pasar el ratón" class="imagen-hover">
							</div>
						</button>
						<button id="clipCheckoutButton" class="clipCheckoutButton"></button>
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
@endsection
