@extends('theme.admin-lte.template')

@section('title') Clientes en deuda @endsection

@section('body')
@parent


@section('content')


    
@section('contentHeader') Administrar clientes en deuda @endsection
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
                            @if ($cliente->getCuotaVencida() == '1')
                            <span class="badge badge-pill bg-Lightblue" >Cuota vencida</span>
                            @endif
                        </td>
                        <td class="text-right" style="">
                            @if ($cliente->estado->id === 4)
                            <a role="button" class="" data-toggle="modal" href="#" data-target="#modal-default-pagarDeuda-{{ $cliente->id }}" title="Saldar deuda">
                              <i class="far fa-badge-dollar"></i>
                            </a>
                            @endif
                            <a title="Editar cliente" href="/clientes/{{ $cliente->id }}/edit/{{ $gimnasio->id }}"><i class="far fa-pencil-alt"></i></a>
                            
                            <a title="Ver cliente" href="/clientes/{{ $cliente->id }}/perfil"><i class="far fa-search-plus"></i></a>
                        </td>
                      </tr>
                      {{-- MODAL DEUDA --}}
                      <div class="modal fade" id="modal-default-pagarDeuda-{{ $cliente->id }}">
                        <div class="modal-dialog">
                          <form method="POST" action="/cuota/pagar_deuda/{{ $cliente->id }}" id="DeudaForm-{{ $cliente->id }}">
                            @csrf
                            <input type="hidden" name="gimnasio" value="{{ $gimnasio->id }}">
                            <input type="hidden" name="cliente" value="{{ $cliente->id }}">
                            @isset($cliente->especialidad)
                            <input type="hidden" name="especialidad" value="{{ $cliente->especialidad->id }}">
                            @endisset
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Agregar pago de deuda de <b>{{ $cliente->nombre }} {{ $cliente->apellido }}</b></h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          
                            <div class="modal-body">
                              @isset($cliente->especialidad)

                                @if ($cliente->getCuotaVencida() == '0')
                                  <div class="card card-danger">
                                    <div class="card-header">
                                      <h3 class="card-title">Deuda</h3>
                      
                                      <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Ocultar/Mostrar" style="margin-top: 1">
                                          <i class="fas fa-minus"></i></button>
                                      </div>
                                      <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body " id="montoDeudaCliente{{ $cliente->id }}">
                                      @if ($cliente->getDeuda() > 0)
                                        <p>
                                            El cliente registra una deuda de </b><span class="badge bg-danger">${{ $cliente->getDeuda() }}</span>
                                        </p>
                                      @else
                                        <p class="text-muted">El cliente no registra deudas</p>
                                      @endif
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                                  <!-- /.card -->
                                @else
                                  <div class="card card-warning" style="width: 230px">
                                    <div class="card-header">
                                      <h3 class="card-title">Montos a pagar</h3>
                      
                                      <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Ocultar/Mostrar" style="margin-top: 1">
                                          <i class="fas fa-minus"></i></button>
                                      </div>
                                      <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="margin-bottom: 0%;" id="montoDeudaCliente{{ $cliente->id }}">
                                      <div class="row">
                                        <div class="col-md-9">
                                          Monto especialidad
                                        </div>
                                        <div class="col-md-1">
                                          <span class="badge bg-warning text-right" style="margin-top: 3;">${{ $cliente->especialidad->monto }}</span>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-9">
                                          Monto de la deuda
                                        </div>
                                        <div class="col-md-1">
                                          <span class="badge bg-danger text-right" style="margin-top: 3;" >${{ $cliente->getDeuda() - $cliente->especialidad->monto }}</span>
                                        </div>
                                      </div>
                                        
                                        <hr style="margin-top: 0em; margin-bottom: 0em;">
                                        <div class="row">
                                          <div class="col-md-9">
                                            Monto total
                                          </div>
                                          <div class="col-md-1">
                                            <span class="badge bg-info text-right" style="margin-top: 3;">${{ $cliente->getDeuda() }}</span>
                                          </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                                  <!-- /.card -->
                                @endif
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
                      </div>
                      
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
                "sEmptyTable":     "No existen clientes que estén en deuda",
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