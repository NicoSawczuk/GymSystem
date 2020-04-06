@extends('theme.admin-lte.template')

@section('title') Estadística @endsection

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

    <script>
        function actualizarChart(id){
            var año = $('#startyear').val();
            $.ajax({
            url:"/gimnasios/actualizar_chart",
            method:"GET",
            data:{id:id, año:año},
            success:function(result){

                var labelsClie = result[0];
                var dataClie = result[1];
                var clientesAnualesChartCanvas = $('#clientesAnualesChart').get(0).getContext('2d')
                var chartOptions     = {
                maintainAspectRatio : false,
                responsive : true,
                legend: {
                display: false
                },
                title: {
                    display: true,
                    text: 'Gráfico de clientes por cada mes en el año '+año,
                    fontSize: 16
                },
                scales: {
                        yAxes: [{
                            ticks: {
                                stepSize: 1,
                                min: 0,
                                max: dataClie.max
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
                            max: dataClie.max
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Meses' ,
                            fontSize: 14
                        }
                    }],
                },
                }

                var clientesAnualesChart = new Chart(clientesAnualesChartCanvas, {
                type: 'line',
                data: {
                    labels: labelsClie,

                    datasets: [{
                        data: dataClie,
                        borderColor: "#14B517",
                        borderColor: colors[5],
                        fill: false
                    }
                    ]

                },
                options: chartOptions      
                })
            }
            })
        }
    </script>
    <body class="container-fluid">
            @if ($gimnasio->clientes->count() > 0)
            
                <div class="card card-teal card-outline">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fal fa-chart-bar"></i> Clientes por cada especialidad
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

                <div class="card card-teal card-outline">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fal fa-chart-line"></i> Clientes mensuales
                        </h3>
          
                        <div class="card-tools">
                            <div class="float-right">
                                <a role="button" id="popover2" data-container="body" title="Ayuda" data-toggle="popover" data-placement="left" data-content="Este gráfico muestra los clientes que se fueron creando en cada mes de un año específico">
                                    <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div style="margin-top: 3px">
                        <div class="input-group float-right" style="width: 120px;margin-right: 18px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                              </div>
                                <select class="form-control" name="startyear" id="startyear" onchange="actualizarChart('{{ $gimnasio->id }}')">
                                    <?php
                                    for ($year = (int)date('Y'); 2000 <= $year; $year--): ?>
                                      <option value="<?=$year;?>"><?=$year;?></option>
                                    <?php endfor; ?>
                                </select>
                        </div>
                    </div>
                    <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">
                        <canvas id="clientesAnualesChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>

                <div class="row">
                    <div class="col col-md-6">
                        <div class="card card-teal card-outline ">
                            <div class="card-header">
                            <h3 class="card-title">
                                <i class="fal fa-chart-pie"></i> Estado de los clientes
                                </h3>
                
                                <div class="card-tools">
                                    <div class="float-right">
                                        <a role="button" id="popover3" data-container="body" title="Ayuda" data-toggle="popover" data-placement="left" data-content="Este gráfico muestra el porcentaje de los estados de los clientes del gimnasio">
                                            <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">
                                <canvas id="estadosChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
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
            $('#popover').popover();
            $('#popover2').popover();
            $('#popover3').popover();
        })
    </script>
        <script>
            var labelsEspe = [];
            var dataEspe = [];
            dataEstados = []
            colors = ["#98FFB7", "#74C9E8","#A38CFF","#FFDB80","#EAFFA6","#C596FF", "#7DE8E6","#FFEC59","#E8E3FF","#B5E2FF","#D599E8", "#88EBAC","#A5EBA4","#FFE078","#7E7DFF","#81C8EB", "#D1FEED","#C4EBBE","#E1FCEE","#F3E1FD","#96FFB7", "#3DC1EB","#FFD359","#A296FF","#96FFFC","#E6E3FE", "#67EBBC","#DE96FF","#E3FFFC"];
        </script>

        @foreach ($especialidades as $clave => $valor)
            <script>
                labelsEspe.push(" {{ $clave }} ");  
                dataEspe.push(" {{ $valor }} "); 
            </script>           
        @endforeach

        @foreach ($gimnasio->getPorcentajeEstados() as $item)
            <script>
                dataEstados.push("{{$item}}");
            </script>
        @endforeach

    {{-- Grafica de clientes x especialidades --}}
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
                        max: dataEspe.max
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
                    max: dataEspe.max
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Especialidades de '+ '{{ $gimnasio->nombre }}' ,
                    fontSize: 14
                }
            }],
        },
        }

        var especialidadesChart = new Chart(especialidadesChartCanvas, {
        type: 'bar',
        data: {
            labels: labelsEspe,

            datasets: [{
                data: dataEspe,
                borderColor: "#14B517",
                backgroundColor: colors,
                fill: false
            }
            ]

        },
        options: chartOptions      
        })
    </script>
    
    <script>
        $(document).ready(function(){
            actualizarChart('{{ $gimnasio->id }}');
        })
    </script>
    
    
    <script>
        var estadosChartCanvas = $('#estadosChart').get(0).getContext('2d')
        var estadosData        = {
        labels: ["No inscriptos","Inscriptos","En regla","En deuda"],
        datasets: [
            {
            data: dataEstados,
            backgroundColor : ["#FFE373", "#68A0E8","#54F5A1","#FF3D5A"],
            }
        ]
        }
        var estadosOptions     = {
        maintainAspectRatio : false,
        responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var estadosChart = new Chart(estadosChartCanvas, {
        type: 'doughnut',
        data: estadosData,
        options: estadosOptions      
        })
    </script>
    </body>
    @endsection

@endsection

@include('theme.admin-lte.scripts')