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
@endsection

@section('content')

    <div class="row mt-5 mb-4 px-2">
        <a href="{{ route('front.admin') }}" class="mt-5 col col-md-2 btn btn-sm btn-dark mr-auto"><i class="fa fa-reply"></i> Regresar</a>
    </div>

    <div class="container-fluid bg-white rounded py-5 mb-5">
        <div class="row">
            <div class="col-6 mt-5">
                <div class="row">
                    <div class="col fs-1 text-center">
                        10 productos más vendidos
                    </div>
                </div>
                <div class="row">
                    <div class="col-7 mx-auto">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-5">
                <div class="row">
                    <div class="col fs-1 text-center">
                        Asesores/vendedores destacados
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <canvas id="asesores"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-5">
                <div class="row">
                    <div class="col fs-1 text-center">
                        Pedidos destacados
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <canvas id="clientes"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-5">
                <div class="row">
                    <div class="col fs-1 text-center">
                        Total de compras/mes
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <canvas id="anticipos"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('extraJS')

<script>
    var pedidos = @json($pedidos);
    console.log(pedidos);

    // Objeto para almacenar el nombre del producto y la cantidad total
    var productos = {};

    // Iterar sobre cada pedido
    pedidos.forEach(pedido => {
        // Verificar si la propiedad 'data' contiene una cadena JSON válida
        if (pedido.data) {
            try {
                let dataObj = JSON.parse(pedido.data);
                // Iterar sobre cada producto dentro del JSON
                for (let key in dataObj) {
                    let producto = dataObj[key].product_name;
                    let cantidad = parseInt(dataObj[key].quantity);
                    // Si el producto ya existe en el objeto 'productos', sumar la cantidad; de lo contrario, agregarlo
                    if (productos.hasOwnProperty(producto)) {
                        productos[producto] += cantidad;
                    } else {
                        productos[producto] = cantidad;
                    }
                }
            } catch (error) {
                console.error("Error al parsear la cadena JSON en data:", error);
            }
        }
    });

    // Convertir el objeto 'productos' a un array para facilitar su manipulación
    var listaProductos = [];
    for (let producto in productos) {
        listaProductos.push({ nombre: producto, cantidad: productos[producto] });
    }

    // Mostrar la lista de productos y sus cantidades totales
    listaProductos.forEach(producto => {
        console.log(producto.nombre + ": " + producto.cantidad);
    });

    // Función para generar un color hexadecimal aleatorio
    function generarColorAleatorio() {
        // Generar componentes RGB aleatorios
        var r = Math.floor(Math.random() * 256);
        var g = Math.floor(Math.random() * 256);
        var b = Math.floor(Math.random() * 256);

        // Convertir componentes RGB a formato hexadecimal
        var colorHexadecimal = "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
        
        return colorHexadecimal;
    }

    // Obtener las etiquetas y datos del gráfico a partir de la lista de productos
    var etiquetas = listaProductos.map(producto => producto.nombre);
    var datos = listaProductos.map(producto => producto.cantidad);

    // Generar colores aleatorios para cada producto
    var coloresFondo = [];
    var coloresBorde = [];
    for (var i = 0; i < listaProductos.length; i++) {
        coloresFondo.push(generarColorAleatorio());
        coloresBorde.push(coloresFondo[i]); // Mismo color para el borde y el fondo
    }

    // Configurar el gráfico con los datos y colores generados
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: etiquetas,
            datasets: [{
                label: 'Total vendido:',
                data: datos,
                backgroundColor: coloresFondo, // Colores aleatorios para el fondo
                borderColor: coloresBorde, // Colores aleatorios para el borde
                borderWidth: 1
            }]
        }
    });

  </script>
  
  <script>
    // Datos para la gráfica de barras
    var vendedores_destacados = @json($clientesPorVendedor);

    var data = {
        labels: [],
        datasets: [{
            label: 'Cantidad de cotizaciones exitosas',
            data: [],
            backgroundColor: [], // Aquí vamos a añadir colores dinámicamente
            borderColor: 'rgba(75, 192, 192, 1)', // Color del borde de las barras
            borderWidth: 1
        }]
    };

    // Recorremos los datos obtenidos y los agregamos a los arreglos correspondientes
    vendedores_destacados.forEach(function(vendedor, index) {
        data.labels.push('Vendedor ' + vendedor.vendedor); // Agregamos el número del vendedor como etiqueta
        data.datasets[0].data.push(vendedor.conteo); // Agregamos el conteo de clientes
        // Definimos un color para cada barra (puedes personalizar esto según tus preferencias)
        var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.2)';
        data.datasets[0].backgroundColor.push(randomColor);
    });

    // Configuración de la gráfica
    var config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true // Empezar el eje y desde cero
                }
            }
        }
    };

    // Crear la instancia de la gráfica
    var ctx = document.getElementById('asesores').getContext('2d');
    var myChart = new Chart(ctx, config);

</script>

<script>
    var pedidosDestacados = @json($pedidos);

    // Ordenamos los pedidos por total en orden descendente
    pedidosDestacados.sort(function(a, b) {
        return b.total - a.total;
    });

    // Tomamos solo los primeros 10 pedidos
    pedidosDestacados = pedidosDestacados.slice(0, 10);

    // Inicializamos arrays vacíos para las etiquetas y los datos
    var labels = [];
    var ventas = [];

    // Recorremos los pedidos y agregamos los datos a los arrays correspondientes
    pedidosDestacados.forEach(function(pedido) {
        labels.push(pedido.uid); // Agregamos el uid del pedido como etiqueta
        ventas.push(pedido.total); // Agregamos el total del pedido como dato
    });

    // Configuración de la gráfica
    var data = {
        labels: labels,
        datasets: [{
            label: 'Total de ventas por pedido',
            data: ventas,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };

    var config = {
        type: 'line',
        data: data
    };

    // Crear la instancia de la gráfica
    var ctx = document.getElementById('clientes').getContext('2d');
    var myChart = new Chart(ctx, config);
</script>

  <script>


var pedidosTotales = @json($pedidos);

var data = {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    datasets: [{
        label: 'Total de ventas',
        data: [100, 150, 200, 180, 250, 300, 280, 320, 350, 400, 380, 420],
        backgroundColor: 'rgb(75, 192, 192)',
        borderColor: 'rgb(54, 162, 235)',
        borderWidth: 1
    }]
};

var config = {
    type: 'bar',
    data: data,
    options: {
        indexAxis: 'x',
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

var ctx = document.getElementById('anticipos').getContext('2d');
var myChart = new Chart(ctx, config);


  </script>

@endsection




