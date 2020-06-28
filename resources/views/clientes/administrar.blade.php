@extends('theme.admin-lte.template')

@section('title') Administrar Inscriptos @endsection

@section('body')
@parent


@section('content')
{{-- Las dos funciones siguientes se utilizan para mostrar el monto de la especialidad (segun corresponda) en el modal para inscribir a un alumno --}}
{{-- <script>
  var valido = false;
  function mostrarMonto(){
    valido = !valido;
    if (valido == true){
      if ($("#especialidad").val() != ""){
        document.getElementById("cardsMontos").style.display = 'block';
      }
    }else{
      document.getElementById("cardsMontos").style.display = 'none';
    }
  }
</script> --}}

<script>
  function cargarMonto(){
    var idEspe = $("#especialidad").val();
    if (idEspe != ""){
      var monto = $("#montoEspecialidad"+idEspe).val();
      console.log(monto);
      const html = 'Monto <span class="badge bg-warning text-right">$'+monto+'</span>'
      $('#cardEspe').html(html);
    }else{
      $('#cardEspe').html('');
    }
  }
</script>


@section('contentHeader') Administrar clientes @endsection

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
              <a title="Agregar un cliente" class="fal fa-plus-circle fa-lg"
                href="{{route('clientes.create',[$gimnasio->id,$gimnasio->slug()])}}"></a>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        @isset($clientes)
        <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">

          {{-- MODAL INSCRIBIR --}}
          <div class="modal fade" id="modal-default-inscripcion">
            <div class="modal-dialog">
              <form method="POST" action="" id="InscripcionForm">
                @csrf
                <input type="hidden" name="gimnasio" id="gimnasio">
                <input type="hidden" name="cliente" id="cliente">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="tituloModal"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">

                    <div class="row">
                      <div class="col-md-6">
                        <div class="card card-outline card-warning">
                          <div class="card-header">
                            <h3 class="card-title">Especialidad</h3>

                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                  class="fas fa-minus"></i>
                              </button>
                            </div>
                            <!-- /.card-tools -->
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <p class="text-muted" id="cardEspe">Seleccione especialidad</p>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <div class="col-md-6">
                        <div class="card card-outline card-danger">
                          <div class="card-header">
                            <h3 class="card-title">Deuda</h3>

                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                  class="fas fa-minus"></i>
                              </button>
                            </div>
                            <!-- /.card-tools -->
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body " id="montoDeudaCliente">
                            <div id="deudaSi" style="display: none;">
                              <p class="text-muted">
                                Monto </b><span class="badge bg-danger" id="montoDeuda"></span>
                              </p>
                            </div>
                            <div id="deudaNo" style="display: none;">
                              <p class="text-muted">El cliente no registra deudas</p>
                            </div>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="form-group col-md-6">
                        <label for="especialidad" class="col-form-label text-md-right">Especialidad</label>
                        <select name="especialidad" id="especialidad" onchange="cargarMonto()"
                          class="form-control select2 select2-hidden-accessible @error('especialidad') is-invalid @enderror"
                          style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                          <option value="" selected disabled>Seleccione especialidad</option>
                          @foreach ($gimnasio->especialidades as $especialidad)
                          <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                          @endforeach
                        </select>
                        @foreach ($gimnasio->especialidades as $especialidad)
                        <input type="hidden" id="montoEspecialidad{{$especialidad->id}}"
                          value="{{ $especialidad->monto }}">
                        @endforeach
                        @error('especialidad')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>

                      <div class="form-group col-md-4">
                        <label class="col-form-label text-md-right"></label>
                        <div class="" style="display:none;" id="montoEspecialidad">

                        </div>
                      </div>

                    </div>

                    <div class="form-group row">
                      <div class="form-group col-md-3">
                        <label for="monto" class="col-form-label text-md-right">Monto</label>
                        <input id="monto" type="number" class="form-control @error('monto') is-invalid @enderror"
                          name="monto" step="0.01" value="{{ old('monto') }}" placeholder="$" min="1" pattern="^[0-9]+"
                          required>
                        @error('monto')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="form-group col-md-7">
                        <label for="detalle" class=" col-form-label text-md-right">Detalle</label>
                        <textarea id="detalle" class="form-control  @error('detalle') is-invalid @enderror" cols="45"
                          rows="2" name="detalle" value="{{ old('detalle') }}"
                          placeholder="Ingrese la descripción">{{ old('detalle') }}</textarea>
                        @error('detalle')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" name="cuota" class="custom-control-input" id="customSwitch1" value="0"
                        id="toggle">
                      <label class="custom-control-label" for="customSwitch1">La inscripción forma parte de la
                        cuota</label>
                    </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fal fa-times"></i>
                      Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fal fa-check"></i> Confirmar</button>
                  </div>

                </div>
                <!-- /.modal-content -->
              </form>
            </div>
            <!-- /.modal-dialog -->
          </div>

          <table id="tabla" class="table table-head-fixed text-nowrap dataTable dtr-inline table-striped">
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
                <td>{{ $cliente->nombre }} {{ $cliente->apellido }}</td>
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
                  <span class="badge badge-pill"
                    style="background-color: {{$cliente->estado->color}}; color: white;">{{ $cliente->estado->nombre }}</span>
                  @if ($cliente->getCuotaVencida() == '1')
                  <span class="badge badge-pill bg-Lightblue">Cuota vencida</span>
                  @endif
                </td>
                <td class="text-right" style="">
                  @if ($cliente->estado->id === 1 or $cliente->estado->id === 5)
                  <a role="button" id="boton"
                    onclick="modal('{{$gimnasio->id}}','{{$cliente->id}}','{{$cliente->slug()}}','{{$cliente->nombre}}','{{$cliente->apellido}}','{{$cliente->getDeuda()}}')"
                    title="Realizar inscripción" href="#">
                    <i class="far fa-user-check fa-lg"></i>
                  </a>
                  @endif
                  <a title="Editar cliente"
                    href="{{route('clientes.edit',[$cliente->id,$cliente->slug(),$gimnasio->id,$gimnasio->slug()])}}"><i
                      class="far fa-pencil-alt fa-lg"></i></a>

                  <a title="Ver perfil" href="{{route('clientes.perfil',[$cliente->id,$cliente->slug()])}}"><i
                      class="far fa-search-plus fa-lg"></i></a>
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
                "sEmptyTable":     "Todavia no tiene clientes en su gimnasio, por agregue uno",
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


  <script>
    function modal(gimId, clieId, slug, clieNombre, clieApellido, clieDeuda){
  $('#modal-default-inscripcion').modal({
        show: true
    });
    $("#InscripcionForm").attr('action', '/inscripcion/create/'+clieId+'-'+slug);
    $('#gimnasio').val(gimId);
    $('#cliente').val(clieId);

    var title = 'Realizar inscripción de <b>'+clieNombre+' '+clieApellido+'</b>'
    $('#tituloModal').html(title);


    if (clieDeuda > 0){
      $('#deudaSi').css({display: 'block'});
      $('#montoDeuda').html('$'+clieDeuda);
    }else{
      $('#deudaNo').css({display: 'block'});
    }

}
  </script>
  <script>
    $('#customSwitch1').on('change', function() {
     $('#customSwitch1').val(1);   
  });  
  </script>

</body>
@endsection


@endsection
@include('theme.admin-lte.scripts')