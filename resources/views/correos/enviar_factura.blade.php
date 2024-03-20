<html>
<head>
	<meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{$data['asunto']}}</title>
	<style>
		body {
			background-color: rgb(126, 126, 201);
		}
	</style>
</head>
<body>
    <h1>Compra exitosa </h1>
	<h4>Nombre:  {{ $data['nombre'] }}</h4>
    <h4>Correo: {{ $data['correo'] }} </h4>
    <h4>Telefono: {{ $data['telefono'] }} </h4>
    <p>{{ $data['mensaje'] }}</p>
</body>
</html>


