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

    <div class="container">
        <div class="r">
            <div class="col-4 mx-auto">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('extraJS')

<script>
    var pedidos = @json($pedidos);
    console.log(pedidos);

    pedidos.forEach(ped => {
    // Asegúrate de que ped.data es una cadena válida en formato JSON
    if (ped.data) {
        try {
            // Parsea la cadena JSON a un objeto JavaScript
            var dataObj = JSON.parse(ped.data);

            // Ahora puedes acceder a los campos dentro de dataObj como un objeto normal
            console.log(dataObj);
            // Por ejemplo, si data tiene un campo llamado 'nombre', puedes hacer:
            console.log(dataObj[1].photo);

        } catch (e) {
            console.error("Error al parsear JSON", e);
        }
    }
});


    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Rojo', 'Azul', 'Amarillo'],
            datasets: [{
                label: '# de Votos',
                data: [12, 19, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        }
    });
  </script>
  
@endsection




