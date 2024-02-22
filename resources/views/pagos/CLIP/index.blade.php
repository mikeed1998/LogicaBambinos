@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Página de pago de Bambinos</h1>
                <p>Total a pagar: ${{ $totalCompra }}</p>
                <p> Aceptamos pagos con <b>Clip</b> </p>
                <button class="clipCheckoutButton"></button>
            </div>
        </div>
    </div>


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
            alert('Pago exitoso!');
            // Redireccionar a la página de agradecimiento (opcional)
            // window.location.href = '/gracias';
          } else if (paymentStatus === 'DECLINED') {
            // Pago fallido, mostrar mensaje de error
            alert('El pago ha sido rechazado.');
          }
        });
      </script>
@endsection
