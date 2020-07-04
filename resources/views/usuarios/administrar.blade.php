@extends('theme.admin-lte.template')

@section('title') Usuarios, roles y permisos @endsection

@section('body')
@parent


@section('content')

@section('contentHeader') Administrar usuarios, roles y permisos @endsection

<body class="container-fluid">
  <div class="">
    <div class="">


      <div class="card card-teal card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fal fa-users"></i>
            Usuarios del sistema
          </h3>

          <div class="card-tools">
            <div class="float-right">

            </div>
          </div>
        </div>
        <!-- /.card-header -->
        @isset($usuarios)
        <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">

          <table id="tabla" class="table table-head-fixed text-nowrap dataTable dtr-inline table-striped">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Roles</th>
                <th>Permisos</th>
                <th class="text-right">Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($usuarios as $usuario)
              <tr>
                <td>{{ $usuario->name }} {{ $usuario->apellido }} </td>
                <td>
                  @foreach ($usuario->roles as $rol)
                  <span class="badge badge-pill badge-light">{{ $rol->name }}</span>
                  @endforeach
                </td>
                <td>
                  @foreach ($usuario->permissions as $permiso)
                  <span class="badge badge-pill badge-light">{{ $permiso->name }}</span>
                  @endforeach
                </td>
                <td class="text-right" style="">
                  @if ($usuario->id != Auth::id())
                  <a title="Editar roles o permisos"
                    href="{{ route('usuarios.edit', [$usuario->id, $usuario->slug(), $gimnasio->id, $gimnasio->slug()]) }}"><i
                      class="fal fa-pencil-alt fa-lg"></i></a>
                  @endif
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
          @endisset


        </div>
        @empty($usuarios)
        <div class="callout callout-warning">
          <h5>Aún no tenes usuarios</h5>

          <p>Los usuarios se deben registrar</p>
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