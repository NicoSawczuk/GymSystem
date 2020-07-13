@extends('theme.admin-lte.template')

@section('title') Ver códigos de descuento @endsection

@section('body')

<body class="container-fluid">
    <div class=" mt-2 row justify-content-center">
        <div class="col-md-9">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Códigos de descuento</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="background: white">
                        <li class="breadcrumb-item"><a href="{{route('usuarios.panel')}}">Panel</a></li>
                        <li class="breadcrumb-item active">Códigos de descuento</li>
                    </ol>
                </div>
            </div>

            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="far fa-barcode-read"></i>
                        Listado de códigos
                    </h3>

                    <div class="card-tools">
                        <div class="float-right">
                            <a title="Agregar montos" class="fal fa-plus-circle fa-lg"
                                href="{{route('descuentos.create')}}">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                @if($codigos->count() > 0)
                <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">

                    <table id="tabla" class="table table-head-fixed text-nowrap table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descuento</th>
                                <th>Fecha expiración</th>
                                <th>Estado</th>
                                <th>Detalle</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($codigos as $codigo)
                            <tr>
                                <td>{{$codigo->codigo}}</td>
                                <td class="text-right">
                                    <span class="badge badge-pill badge-light">
                                        {{ $codigo->porcentaje_descuento }}%
                                    </span>
                                </td>
                                <td class="text-right">
                                    {{ \Carbon\Carbon::parse($codigo->fecha_expiracion)->format('d/m/Y ')}}
                                </td>
                                @if($codigo->usado === 1)
                                <td class="text-right">
                                    <span class="badge badge-pill badge-warning">Usado</span>
                                </td>
                                @else
                                <td class="text-right">
                                    <span class="badge badge-pill badge-success">Sin uso</span>
                                </td>
                                @endif
                                <td>{{$codigo->detalle}}</td>
                                <td class="text-right">
                                    <a title="Editar monto"
                                        href="{{route('descuentos.edit',[$codigo->id, $codigo->slug()])}}"><i
                                            class="fal fa-pencil-alt fa-lg"></i>
                                    </a>
                                    <a title="Eliminar codigo"
                                        onclick="borrar('{{ $codigo->id }}','{{$codigo->codigo}}','{{$codigo->slug()}}')"
                                        href="#">
                                        <i class="fal fa-trash-alt fa-lg"></i>
                                    </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else

                </div>
                <div class="callout callout-warning">
                    <h5>Aún no existen codigos de descuento</h5>

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

    <script>
        function ajaxBorrar(id, slug){
        $.ajax({
          url:"/descuentos/"+id+"-"+slug,
          method:"GET",
          data:{id:id},
          success:function(result){
              console.log(result);
            if (result === '1'){
              Swal.fire({
              icon: 'success',
              title: 'Código eliminado',
              text: 'El código de descuento se eliminó con éxito',
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
              icon: 'error',
              title: 'Fallo en eliminar el código',
              text: 'El código no pudo ser eliminado',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Ok'
            })
            }
          }
        })
      }
      </script>
    
    
    
      <script>
        function borrar(id, codigo, slug){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
      })
    
      swalWithBootstrapButtons.fire({
        title: 'Eliminar codigo de descuento',
        text: 'El codigo de descuento '+codigo+' se borrará del sistema, está seguro que desea hacerlo?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
      if (result.value) {
        ajaxBorrar(id, slug);
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelado',
          'No se eliminará el código',
          'error'
        )
      }
    })
      }
      </script>
</body>


@endsection
@include('theme.admin-lte.scripts')