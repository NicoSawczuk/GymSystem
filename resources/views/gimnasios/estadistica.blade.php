@extends('theme.admin-lte.template')

@section('title') Estadística especialidades @endsection

@section('body')
    @parent
    @section('nombreGimnasio') <strong>{{ $gimnasio->nombre }}</strong> @endsection

    @section('usuario')
        {{ Auth::user()->name }} {{ Auth::user()->apellido }}
    @endsection


    @section('contentHeader')
        Estadística
    @endsection

    @section('content')   
    <body class="container-fluid">
            @if ($gimnasio->clientes->count() >0)
                <div class="card card-teal card-outline">
                    <div class="card-header">
                      <h3 class="card-title">
                          Clientes por cada especialidad
                        </h3>
          
                        <div class="card-tools">
                            <div class="float-right">
                                <a role="button" id="popover" data-container="body" title="Ayuda" data-toggle="popover" data-placement="left" data-content="Este gráfico muestra la cantidad de clientes que tiene cada una de las especialidades que brinda el gimnasio">
                                    <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">
                        <canvas id="especialidadesChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
            @else
                <div class="callout callout-warning">
                    <h5>Aún no tenes clientes</h5>
    
                    <p>Por favor crea uno para ver el grafico</p>
                </div>
            @endif
                <!-- /.card -->

    <script>
        $(function () {
            $('#popover').popover()
        })
    </script>
        <script>
            var labels = [];
            var data = [];
            colors = ["#98FFB7", "#74C9E8","#A38CFF","#FFDB80","#EAFFA6","#C596FF", "#7DE8E6","#FFEC59","#E8E3FF","#B5E2FF","#D599E8", "#88EBAC","#A5EBA4","#FFE078","#7E7DFF","#81C8EB", "#D1FEED","#C4EBBE","#E1FCEE","#F3E1FD","#96FFB7", "#3DC1EB","#FFD359","#A296FF","#96FFFC","#E6E3FE", "#67EBBC","#DE96FF","#E3FFFC"];
        </script>

        @foreach ($especialidades as $clave => $valor)
            <script>
                labels.push(" {{ $clave }} ");  
                data.push(" {{ $valor }} "); 
            </script>           
        @endforeach

    <script>
        var especialidadesChartCanvas = $('#especialidadesChart').get(0).getContext('2d')
        var chartOptions     = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
          display: false
        },
        title: {
            display: true,
            text: 'Gráfico de clientes por cada especialidad',
            fontSize: 16
        },
        scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 1,
                        min: 0,
                        max: data.max
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Cantidad de clientes',
                        fontSize: 14
                    }
                }],
        
        xAxes: [{
                ticks: {
                    beginAtZero: false,
                    stepSize: 1,
                    min: 0,
                    max: data.max
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Especialidades de '+ '{{ $gimnasio->nombre }}' ,
                    fontSize: 14
                }
            }],
        },
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var especialidadesChart = new Chart(especialidadesChartCanvas, {
        type: 'bar',
        data: {
            labels: labels,

            datasets: [{
                data: data,
                borderColor: "#14B517",
                backgroundColor: colors,
                fill: false
            }
            ]

        },
        options: chartOptions      
        })
    </script>
    
    </body>
    @endsection

@endsection

@include('theme.admin-lte.scripts')