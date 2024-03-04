<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@9.17.0/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <script>
        $(document).ready(function() {
            let tipo = "{{ $tipo }}";
            let titulo = "{{ $titulo }}";
            let mensaje = "{{ $mensaje }}";
            let rutaRedireccion = "{{ $rutaRedireccion }}";

            swal({
                title: titulo,
                text: mensaje,
                icon: tipo,
            }).then(() => {
                window.location.href = rutaRedireccion;
            });
        });
    </script>
</body>
</html>
