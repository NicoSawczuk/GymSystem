@extends('theme.admin-lte.template')

@section('title') Clientes Inscriptos @endsection

@section('body')
@parent


@section('content')

    
@section('contentHeader') Administrar clientes inscriptos @endsection
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
                
                  {{-- MODAL CUOTA --}}
                  <div class="modal fade" id="modal-default-cuota">
                    <div class="modal-dialog">
                      <form method="" action="" id="CuotaForm">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="gimnasio" id="gimnasio" value="">
                        <input type="hidden" name="cliente" id ="cliente" value="">
                        <input type="hidden" name="especialidad" id="especialidad" value="">
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
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                  </button>
                                </div>
                                <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">
                                <p class="text-muted">Monto de <b id="nombreEspe"></b><span class="badge bg-warning" id="montoEspe"></span></p>
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
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                  </button>
                                </div>
                                <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body " id="montoDeudaCliente">
                                <div id="deudaSi" style="display: none;">
                                  <p class="text-muted">
                                      El cliente registra una deuda de </b><span class="badge bg-danger" id="montoDeuda"></span>
                                  </p>
                                </div>
                                <div id="deudaNo" style="display: none;">
                                  <p class="text-muted" >El cliente no registra deudas</p>
                                </div>
                              </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                          </div>
                          </div>

                          <div class="form-group row">
                            <div class="form-group col-md-3">
                              <label for="monto_pagar" class="col-form-label text-md-right">Monto a pagar</label>
                              <input id="monto_pagar" type="number" class="form-control @error('monto') is-invalid @enderror" name="monto" step="0.01" value="{{ old('monto') }}" placeholder="$" min="1" pattern="^[0-9]+" required>

                              @error('monto')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fal fa-times"></i> Cancelar</button>
                          <button type="submit" class="btn btn-primary"><i class="fal fa-check"></i> Confirmar</button>
                        </div>
                      
                      </div>
                      <!-- /.modal-content -->
                    </form>
                    </div>
                    <!-- /.modal-dialog -->
                  </div> 

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
                            @if ($cliente->estado->id === 2)
                            <a role="button" class="" data-toggle="modal" href="#" onclick="modal('{{$gimnasio->id}}','{{$cliente->id}}','{{$cliente->especialidad->id}}','{{$cliente->especialidad->nombre}}','{{$cliente->especialidad->monto}}','{{$cliente->getDeuda()}}','{{$cliente->nombre}}','{{$cliente->apellido}}')" title="Agregar pago">
                              <i class="far fa-money-check-alt fa-lg"></i>
                            </a>
                            @endif
                            <a title="Editar cliente" href="/clientes/{{ $cliente->id }}/edit/{{ $gimnasio->id }}"><i class="far fa-pencil-alt fa-lg"></i></a>
                            
                            <a title="Ver cliente" href="/clientes/{{ $cliente->id }}/perfil"><i class="far fa-search-plus fa-lg"></i></a>
                        </td>
                      </tr>
                      {{-- MODAL CUOTA
                      <div class="modal fade" id="modal-default-cuota-{{ $cliente->id }}">
                        <div class="modal-dialog">
                          <form method="POST" action="/cuota/create/{{ $cliente->id }}" id="CuotaForm-{{ $cliente->id }}">
                            @csrf
                            <input type="hidden" name="gimnasio" value="{{ $gimnasio->id }}">
                            <input type="hidden" name="cliente" value="{{ $cliente->id }}">
                            @isset($cliente->especialidad)
                            <input type="hidden" name="especialidad" value="{{ $cliente->especialidad->id }}">
                            @endisset
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Agregar pago de cuota de <b>{{ $cliente->nombre }} {{ $cliente->apellido }}</b></h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          
                            <div class="modal-body">
                              @isset($cliente->especialidad)
                              <div class="row">
                              <div class="col-md-6">
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h3 class="card-title">Monto</h3>
                    
                                    <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                      </button>
                                    </div>
                                    <!-- /.card-tools -->
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body">
                                    <p>Monto de <b>{{ $cliente->especialidad->nombre }} </b><span class="badge bg-warning">${{ $cliente->especialidad->monto }}</span></p>
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              </div>
                              <div class="col-md-6">
                                <div class="card card-danger">
                                  <div class="card-header">
                                    <h3 class="card-title">Deuda</h3>
                    
                                    <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                      </button>
                                    </div>
                                    <!-- /.card-tools -->
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body " id="montoDeudaCliente{{ $cliente->id }}">
                                    @if ($cliente->getDeuda() > 0)
                                      <p>
                                        <h5>
                                          El cliente registra una deuda de </b><span class="badge bg-danger"> {{ $cliente->getDeuda() }}</span>
                                        </h5>
                                      </p>
                                    @else
                                      <p class="text-muted">El cliente no registra deudas</p>
                                    @endif
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              </div>
                              </div>
                              @endisset
                              <div class="form-group row">
                                <div class="form-group col-md-3">
                                  <label for="monto_pagar" class="col-form-label text-md-right">Monto a pagar</label>
                                  <input id="monto_pagar{{$cliente->id}}" type="number" class="form-control @error('monto') is-invalid @enderror" name="monto" step="0.01" value="{{ old('monto') }}" placeholder="$" min="1" pattern="^[0-9]+" required>
  
                                  @error('monto')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              </div>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fal fa-times"></i> Cancelar</button>
                              <button type="submit" class="btn btn-primary"><i class="fal fa-check"></i> Confirmar</button>
                            </div>
                          
                          </div>
                          <!-- /.modal-content -->
                        </form>
                        </div>
                        <!-- /.modal-dialog -->
                      </div> --}}
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
                "sEmptyTable":     "No existen clientes que solo estén inscriptos",
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
  function modal(gimId, clieId, espeId, espeNombre, espeMonto, deuda, clieNombre, clieApellido){
    $('#modal-default-cuota').modal({
          show: true
      });
      $("#CuotaForm").attr({action:'/cuota/create/'+clieId+'',method:'POST'});
      $('#gimnasio').val(gimId);
      $('#cliente').val(clieId);
      $('#especialidad').val(espeId);
  
      var title = 'Agregar pago de cuota de <b>'+clieNombre+' '+clieApellido+'</b>'
      $('#tituloModal').html(title);

      $('#nombreEspe').html(espeNombre);
      $('#montoEspe').html(espeMonto);

      if (deuda == '0'){
        console.log('entra en deuda + cero');
        $('#deudaSi').css('style', 'display : block;');
        $('#montoDeuda').html('$'+deuda);
      }else{
        console.log('entra en deuda - cero');
        $('#deudaNo').attr('style', 'display : block;');
      }
  
  
  }
  </script>


</body>
@endsection


@endsection
@include('theme.admin-lte.scripts')