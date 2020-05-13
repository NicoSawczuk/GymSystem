@extends('theme.admin-lte.template')

@section('title') Administrar cuotas @endsection

@section('body')
@parent


@section('content')

@section('contentHeader') Administrar cuotas @endsection

<body class="container-fluid">
    <div class="">
        <div class="">


            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        Cuotas de todos los gimnasios
                    </h3>
                    <div class="card-tools">
                        <div class="float-right">
                            <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                @isset($cuotas)
                <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">

                    <div class="table-responsive">
                        <table id="tabla" class="table table-head-fixed text-nowrap table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Gimnasio</th>
                                    <th>Fecha de pago</th>
                                    <th>Especialidad</th>
                                    <th>Monto</th>
                                    <th>Monto pago</th>
                                    <th>Deuda</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cuotas as $cuota)
                                <tr>
                                    <td>{{$cuota->cliente->nombre}} {{$cuota->cliente->apellido}}</td>
                                    <td>{{$cuota->gimnasio->nombre}}</td>
                                    <td class="text-right">
                                        {{ \Carbon\Carbon::create($cuota->fecha_pago)->format('d/m/Y')}}</td>
                                    <td>
                                        <span class="badge badge-pill badge-light">{{ $cuota->especialidad->nombre }}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span class="badge badge-pill badge-warning">${{$cuota->monto_cuota}}</span>
                                    </td>
                                    <td class="text-right">
                                        <span class="badge badge-pill badge-success">${{$cuota->monto_pagado}}</span>
                                    </td>
                                    <td class="text-right">
                                        <span class="badge badge-pill badge-danger">${{$cuota->monto_deuda}}</span>
                                    </td>
                                    <td>
                                        @if ($cuota->vencido == 0)
                                        Activa
                                        @else
                                        Vencida
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endisset


                </div>
                @empty($cuotas)
                <div class="callout callout-warning">
                    <h5>Aún no tenes cuotas</h5>

                    <p>Tus clientes aún no han pagado ninguna cuota</p>
                </div>
                @endempty
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>





    <script>
        $(function () {
      $("#tabla").DataTable({
        "responsive": true,
        "autoWidth": false,
        "lengthChange": true,
        "ordering": true,
        language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Ver _MENU_",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Todavía no se registraron pagos",
                "sInfo":           "Mostrando del _START_ al _END_ de _TOTAL_",
                "sInfoEmpty":      "Mostrando  del 0 al 0 de de 0 ",
                "sInfoFiltered":   "(filtrado de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Sig",
                    "sPrevious": "Ant"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
    }
      });
    });
    </script>


</body>
@endsection


@endsection
@include('theme.admin-lte.scripts')