@extends('theme.admin-lte.template')

@section('title') Ver montos mensuales @endsection

@section('body')

<body class="container-fluid">
    <div class=" mt-2 row justify-content-center">
        <div class="col-md-9">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Montos mensuales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="background: white">
                        <li class="breadcrumb-item"><a href="{{route('usuarios.panel')}}">Panel</a></li>
                        <li class="breadcrumb-item active">Montos mensuales</li>
                    </ol>
                </div>
            </div>

            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="far fa-usd-square"></i>
                        Listado de montos mensuales
                    </h3>

                    <div class="card-tools">
                        <div class="float-right">
                            <a title="Agregar montos" class="fal fa-plus-circle fa-lg"
                                href="{{route('montosMensuales.create')}}">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                @if($montos->count() > 0)
                <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">

                    <table id="tabla" class="table table-head-fixed text-nowrap table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Monto</th>
                                <th>Mes</th>
                                <th>Año</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($montos as $montoM)
                            <tr>
                                <td class="text-right">
                                    <span class="badge badge-pill badge-light">$ {{ $montoM->monto }}</span>
                                </td>
                                <td class="text-right">{{ $montoM->mes }}</td>
                                <td class="text-right">{{ $montoM->ano }}</td>
                                <td class="text-right">
                                    <a title="Editar monto"
                                        href="{{route('montosMensuales.edit',[$montoM->id, $montoM->slug()])}}"><i
                                            class="fal fa-pencil-alt fa-lg"></i>
                                    </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else

                </div>
                <div class="callout callout-warning">
                    <h5>Aún no existen montos mensuales</h5>

                    <p>Por favor agregalos</p>
                </div>
                @endif
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
                  "sEmptyTable":     "Aún no hay gimnasios que mostrar, por favor carga uno",
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




    @if (session('success'))
    <script>
        Notiflix.Notify.Success(String(' {{ session('success') }} '));
    </script>
    @endif
    @if (session('error'))
    <script>
        Notiflix.Notify.Failure(String(' {{ session('error') }} '));
    </script>
    @endif

</body>


@endsection
@include('theme.admin-lte.scripts')