@extends('theme.admin-lte.template')

@section('title') Clientes en regla @endsection

@section('body')
@parent


@section('content')

    
@section('contentHeader') Administrar clientes en regla @endsection
<body class="container-fluid">
    <div class="">
        <div class="">


            <div class="card card-teal card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                  Clientes de <b>{{$gimnasio->nombre}}</b>
                    </h3>
      
                  <div class="card-tools">
                    <div class="float-right">
                        <a title="Agregar un cliente" class="fal fa-plus-circle fa-lg" href="/clientes/create/{{ $gimnasio->id }}"></a>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                @isset($clientes)
                <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">
                
                  <table id="tabla"class="table table-head-fixed text-nowrap dataTable dtr-inline ">
                    <thead>
                      <tr>
                        <th>Nombre, Apellido</th>
                        <th>Edad</th>
                        <th>Especialidad</th>
                        <th>Estado</th>
                        <th class="text-right">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($clientes as $cliente)
                      <tr>
                        <td >{{ $cliente->nombre }} {{ $cliente->apellido }}</td>
                        <td class="text-right">
                            {{ $cliente->getEdad() }}
                        </td>
                        <td>
                          @isset($cliente->especialidad)
                          <span class="badge badge-pill badge-light">{{ $cliente->especialidad->nombre }}</span>
                          @else
                          <span class="badge badge-pill bg-pink">Sin especialidad</span>
                          @endisset
                        </td>
                        <td>
                            <span class="badge badge-pill" style="background-color: {{$cliente->estado->color}}; color: white;">{{ $cliente->estado->nombre }}</span>
                        </td>
                        <td class="text-right" style="">

                            <a title="Editar cliente" href="/clientes/{{ $cliente->id }}/edit/{{ $gimnasio->id }}"><i class="far fa-pencil-alt fa-lg"></i></a>
                            
                            <a title="Ver cliente" href="/clientes/{{ $cliente->id }}/perfil"><i class="far fa-search-plus fa-lg"></i></a>
                        </td>
                      </tr>
                      
                    @endforeach
                    </tbody>
                  </table>
                @endisset
                
                
                </div>
                @empty($clientes)
                <div class="callout callout-warning">
                  <h5>Aún no tenes inscriptos en este gimnasio</h5>

                  <p>Puedes agregar uno</p>
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
                "sEmptyTable":     "No existen clientes que estén en regla",
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

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    })

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
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