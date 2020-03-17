@extends('theme.admin-lte.template')

@section('title') Administrar Inscriptos @endsection

@section('body')
@parent
@section('nombreGimnasio')
    <strong>{{ $gimnasio->nombre }}</strong>
@endsection

@section('content')
    
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
                        <a title="Agregar un cliente" class="fal fa-plus-circle fa-lg" href="/clientes/create/{{ $gimnasio->id }}"></a>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                @isset($clientes)
                <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">
                
                  <table id="tabla"class="table table-head-fixed text-nowrap dataTable dtr-inline">
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
                        <td >
                            {{ $cliente->getEdad() }}
                        </td>
                        <td>
                          <span class="badge badge-pill badge-light">{{ $cliente->especialidad->nombre }}</span>
                        </td>
                        <td>
                            <span class="badge badge-pill" style="background-color: {{$cliente->estado->color}}; color: white;">{{ $cliente->estado->nombre }}</span>
                        </td>
                        <td class="text-right" style="">
                            @if ($cliente->estado->id === 1)
                            <a role="button" class="" data-toggle="modal" href="#" data-target="#modal-default-inscripcion-{{ $cliente->id }}" title="Realizar inscripción">
                              <i class="fal fa-user-check"></i>
                            </a>
                            @endif
                            @if ($cliente->estado->id === 2)
                            <a role="button" class="" data-toggle="modal" href="#" data-target="#modal-default-cuota-{{ $cliente->id }}" title="Agregar pago">
                              <i class="fal fa-money-check-alt"></i>
                            </a>
                            @endif
                            <a title="Editar inscripto" href="/clientes/{{ $cliente->id }}/edit"><i class="fal fa-pencil-alt"></i></a>
                            
                            <a title="Eliminar inscripto" href="#"><i class="fal fa-trash-alt"></i></a>
                        </td>
                      </tr>
                      {{-- MODAL INSCRIBIR --}}
                      <div class="modal fade" id="modal-default-inscripcion-{{ $cliente->id }}">
                          <div class="modal-dialog">
                            <form method="POST" action="/inscripcion/create/{{ $cliente->id }}" id="InscripcionForm-{{ $cliente->id }}">
                              @csrf
                              <input type="hidden" name="gimnasio" value="{{ $gimnasio->id }}">
                              <input type="hidden" name="cliente" value="{{ $cliente->id }}">
                              <input type="hidden" name="especialidad" value="{{ $cliente->especialidad->id }}">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Realizar inscripción de <b>{{ $cliente->nombre }} {{ $cliente->apellido }}</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                            
                              <div class="modal-body">
                                
                                <div class="form-group row">
                                  <div class="form-group col-md-3">
                                    <label for="monto" class="col-form-label text-md-right">Monto</label>
                                    <input id="monto{{$cliente->id}}" type="number" class="form-control @error('monto') is-invalid @enderror" name="monto" step="0.01" value="{{ old('monto') }}" placeholder="$" required>
    
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
                                    <textarea id="detalle{{$cliente->id}}" class="form-control  @error('detalle') is-invalid @enderror" cols="45" rows="2" name="detalle" value="{{ old('detalle') }}" placeholder="Ingrese la descripción" required>{{ old('detalle') }}</textarea>
                                    @error('detalle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" name="cuota" class="custom-control-input" id="customSwitch1{{$cliente->id}}" value="1">
                                  <label class="custom-control-label" for="customSwitch1{{$cliente->id}}">La inscripción forma parte de la cuota</label>
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

                      {{-- MODAL CUOTA --}}
                      <div class="modal fade" id="modal-default-cuota-{{ $cliente->id }}">
                        <div class="modal-dialog">
                          <form method="POST" action="/cuota/create/{{ $cliente->id }}" id="CuotaForm-{{ $cliente->id }}">
                            @csrf
                            <input type="hidden" name="gimnasio" value="{{ $gimnasio->id }}">
                            <input type="hidden" name="cliente" value="{{ $cliente->id }}">
                            <input type="hidden" name="especialidad" value="{{ $cliente->especialidad->id }}">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Agregar pago de cuota de <b>{{ $cliente->nombre }} {{ $cliente->apellido }}</b></h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          
                            <div class="modal-body">
                              
                              <div class="form-group row">
                                <p>Monto de especialidad <b>{{ $cliente->especialidad->nombre }}</b><h5><span class="badge bg-info">${{ $cliente->especialidad->monto }}</span></h5></p>
                              </div>
                              <div class="form-group row">
                                <div class="form-group col-md-3">
                                  <label for="monto_pagar" class="col-form-label text-md-right">Monto a pagar</label>
                                  <input id="monto_pagar{{$cliente->id}}" type="number" class="form-control @error('monto') is-invalid @enderror" name="monto" step="0.01" value="{{ old('monto') }}" placeholder="$" required>
  
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