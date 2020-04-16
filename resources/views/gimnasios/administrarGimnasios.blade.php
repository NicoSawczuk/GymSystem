@extends('theme.admin-lte.template')

@section('title') Administrar gimnasios @endsection

@section('body')
<body class="container-fluid">
    <div class=" mt-4 row justify-content-center">
        <div class="col-md-9">


            <div class="card card-teal card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <a href="javascript:history.back()"><i class="fas fa-angle-left fa-lg" style="color: #495057;"></i></a>
                    Mis gimnasios
                  </h3>
      
                  <div class="card-tools">
                    <div class="float-right">
                        <a title="Agregar un gimnasio" class="fal fa-plus-circle fa-lg" href="/gimnasios/create/{{ Auth::user()->id }}"></a>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                @isset($gimnasios)
                <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">
                
                  <table id="tabla" class="table table-head-fixed text-nowrap table-striped">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Especialidad</th>
                        <th>Dirección</th>
                        <th>Clientes</th>
                        <th>Estado</th>
                        <th class="text-right">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($gimnasios as $gimnasio)
                      <tr>
                        <td >{{ $gimnasio->nombre }}</td>
                        <td>
                            @foreach ($gimnasio->especialidades as $especialidad)
                                <span class="badge badge-pill badge-light">{{ $especialidad->nombre }}</span>
                            @endforeach
                        </td>
                        <td>{{ $gimnasio->calle }} {{ $gimnasio->altura }}</td>
                        <td class="text-right">{{ $gimnasio->getClientes() }}</td>
                        <td>
                          @if ($gimnasio->estado === 1)
                            <span class="badge badge-pill bg-teal">Activo</span>
                          @else
                            <span class="badge badge-pill bg-maroon">Inactivo</span>
                          @endif
                        </td>
                        <td class="text-right">
                            <a title="Editar gimnasio" href="/gimnasios/{{ $gimnasio->id }}/edit"><i class="fal fa-pencil-alt fa-lg"></i></a>
                            @if ($gimnasio->estado == 1)
                              <a title="Cambiar estado a inactivo" onclick="inactivo('{{ $gimnasio->nombre }}','{{ $gimnasio->id }}')" href="#"><i class="fal fa-eye fa-lg"></i></a>
                            @else
                            <a title="Cambiar estado a activo" onclick="activo('{{ $gimnasio->nombre }}','{{ $gimnasio->id }}')" href="#"><i class="far fa-eye-slash fa-lg"></i></a>
                            @endif
                            <a title="Ingresar con gimnasio" href="/home/{{$gimnasio->id}}"><i class="far fa-arrow-circle-right fa-lg"></i></a>
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

<script>
  function ajaxInactivo(id){
    $.ajax({
      url:"/gimnasios/ocultar",
      method:"GET",
      data:{id:id,},
      success:function(result){
        if ( result === '1'){
          Swal.fire({
          title: 'Cambio de estado',
          text: 'Cambio de estado con éxito',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          timer: 3500,
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
            location.reload();
          }else{
            location.reload();
          }
        })
        }else{
          Swal.fire({
          title: 'Cambio de estado',
          text: 'No se pudo realizar el cambio de estado porque el gimnasio contiene clientes asociados',
          icon: 'error',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Ok'
        })
        }
      }
    })
  }
</script>

<script>
  function ajaxActivo(id){
    $.ajax({
      url:"/gimnasios/mostrar",
      method:"GET",
      data:{id:id,},
      success:function(result){
        Swal.fire({
          title: 'Cambio de estado',
          text: 'Cambio de estado con éxito',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          timer: 3500,
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
            location.reload();
          }else{
            location.reload();
          }
        })
      }
    })
  }
</script>



<script>
  function inactivo(gimnasio, id){
    const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true
  })

  swalWithBootstrapButtons.fire({
    title: 'Cambio de estado',
    text: 'El estado de '+gimnasio+' pasará a estar inactivo, esta seguro que desea hacerlo?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    reverseButtons: true
}).then((result) => {
  if (result.value) {
    ajaxInactivo(id);
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelado',
      'El gimnasio permanecerá activo',
      'error'
    )
  }
})
  }
</script>
<script>
  function activo(gimnasio, id){
    const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true
  })

  swalWithBootstrapButtons.fire({
    title: 'Cambio de estado',
    text: 'El estado de '+gimnasio+' pasará a estar activo, esta seguro que desea hacerlo?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      ajaxActivo(id);
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Cancelado',
        'El gimnasio permanecerá inactivo',
        'error'
      )
    }
  })
  }
</script>




</body>


@endsection
@include('theme.admin-lte.scripts')