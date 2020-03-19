@extends('theme.admin-lte.template')

@section('title') Administrar especialidades @endsection

@section('body')
@parent


@section('content')
    
@section('contentHeader') Administrar especialidades @endsection
<body class="container-fluid">
    <div class="">
        <div class="">


            <div class="card card-teal card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                      Especialidades ofrecidas
                    </h3>
      
                  <div class="card-tools">
                    <div class="float-right">
                    <a title="Agregar una especialidad" class="fal fa-plus-circle fa-lg" href="/especialidades/{{ $gimnasio->id }}/create"></a>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                @isset($especialidades)
                <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">
                
                  <table id="tabla"class="table table-head-fixed text-nowrap dataTable dtr-inline">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Monto</th>
                        <th class="text-right">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($especialidades as $especialidad)
                      <tr>
                        <td >{{ $especialidad->nombre }}</td>
                        <td >
                            {{ $especialidad->descripcion }}
                        </td>
                        <td class="text-right">
                          ${{ $especialidad->monto }}
                      </td>
                        <td class="text-right" style="">
                            <a title="Editar especialidad" href="/especialidades/{{ $gimnasio->id }}/{{ $especialidad->id }}/edit"><i class="fal fa-pencil-alt"></i></a>
                            
                            <a title="Eliminar especialidad" href="#"><i class="fal fa-trash-alt"></i></a>
                        </td>

                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                @endisset
                
                
                </div>
                @empty($especialidades)
                <div class="callout callout-warning">
                  <h5>Aún no tenes especialidades</h5>

                  <p>Por favor crea una</p>
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
        "ordering": false,
        language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Ver _MENU_",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
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


@endsection
@include('theme.admin-lte.scripts')