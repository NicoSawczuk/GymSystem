@extends('theme.admin-lte.template')

@section('title') Administrar gimnasios @endsection

@section('body')
<body class="container">
    <div class=" mt-4 row justify-content-center">
        <div class="col-md-8">


            <div class="card card-teal card-outline">
                <div class="card-header">
                  <h3 class="card-title">Mis gimnasios</h3>
      
                  <div class="card-tools">
                    <div class="float-right">
                        <a title="Agregar un gimnasio" class="fal fa-plus-circle fa-lg" href="/gimnasios/create/{{ Auth::user()->id }}"></a>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                @isset($gimnasios)
                <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">
                
                  <table id="tabla" class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Especialidad</th>
                        <th>Dirección</th>
                        <th>Inscriptos</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($gimnasios as $gimnasio)
                      <tr>
                        <td ><a href="/home/{{$gimnasio->id}}">{{ $gimnasio->nombre }}</a></td>
                        <td>
                            @foreach ($gimnasio->especialidades as $especialidad)
                                <span class="badge badge-pill badge-light">{{ $especialidad->nombre }}</span>
                            @endforeach
                        </td>
                        <td>{{ $gimnasio->calle }} {{ $gimnasio->altura }}</td>
                        <td></td>
                        <td>
                          @if ($gimnasio->estado === 1)
                            <span class="badge badge-pill bg-teal">Activo</span>
                          @else
                            <span class="badge badge-pill bg-maroon">Inactivo</span>
                          @endif
                        </td>
                        <td>
                            <a title="Editar gimnasio" href="/gimnasios/{{ $gimnasio->id }}/edit"><i class="fal fa-pencil-alt"></i></a>
                            @if ($gimnasio->estado == 1)
                              <a title="Cambiar estado a inactivo" onclick="inactivo('{{ $gimnasio->nombre }}')" href="#"><i class="fal fa-eye"></i></a>
                            @else
                            <a title="Cambiar estado a activo" onclick="activo('{{ $gimnasio->nombre }}')" href="#"><i class="far fa-eye-slash"></i></a>
                            @endif
                        </td>

                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                @endisset
                
                </div>
                @empty($gimnasios)
                <div class="callout callout-warning">
                  <h5>Aún no tenes gimnasios</h5>

                  <p>Por favor crea uno</p>
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
          "lengthChange": false,
          "ordering": false,
          language: {
                  "sProcessing":     "Procesando...",
                  "sLengthMenu":     "Mostrar _MENU_",
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

<script>
  function inactivo(gimnasio){
    Notiflix.Confirm.Show(
      'Cambio de estado',
      'El estado de '+gimnasio+' pasará a estar inactivo, esta seguro que desea hacerlo?',
      'Confirmar',
      'Cancelar',

      // ok button callback
      function(){
        // codes...
        console.log('confirmado');
      },

      // cancel button callback
      function(){
        // codes...
        console.log('cancelado');
      },
    );
  }
</script>
<script>
    function activo(gimnasio){
    Notiflix.Confirm.Show(
      'Cambio de estado',
      'El estado de '+gimnasio+' pasará a estar activo, esta seguro que desea hacerlo?',
      'Confirmar',
      'Cancelar',

      // ok button callback
      function(){
        // codes...
        console.log('confirmado');
      },

      // cancel button callback
      function(){
        // codes...
        console.log('cancelado');
      },
    );
  }
</script>



</body>


@endsection
@include('theme.admin-lte.scripts')