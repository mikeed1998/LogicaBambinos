<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exito</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@9.17.0/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        @font-face {
            font-family: 'Mairy Bold';
            src: url('vendor/fonts/Mairy_Bold.otf') format('opentype');
        }

        .success-animation { margin:50px auto;}

        .checkmark {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #4bb71b;
            stroke-miterlimit: 10;
            box-shadow: inset 0px 0px 0px #4bb71b;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
            position:relative;
            top: 5px;
            right: 5px;
            margin: 0 auto;
        }

        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #4bb71b;
            fill: #fff;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;

        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scale {
            0%, 100% {
                transform: none;
            }

            50% {
                transform: scale3d(1.1, 1.1, 1);
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px #4bb71b;
            }
        }
    </style>
</head>
<body>
    <div class="success-animation">
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
    </div>
    <div style="text-align: center; font-size: 5rem; font-weight: 700; color: #4bb71b; font-family: 'Mairy Bold';">
        ¡Pago exitoso!
    </div>
    <div style="text-align: center; font-size: 3rem; font-weight: 700; color: rgb(112, 32, 0); font-family: 'Mairy Bold';">
        Ya puedes consultar la compra en tus pedidos (desde tu perfil)
    </div>
    <div style="text-align: center; font-size: 3rem; font-weight: 700; color: rgb(112, 32, 0); font-family: 'Mairy Bold';">
        Espera unos segundos en lo que te mandamos a tu cuenta.
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "/home";
        }, 7000);
    </script>
</body>
</html>
