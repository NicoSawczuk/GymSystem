@extends('theme.admin-lte.template')

@section('title') Administrar Inscriptos @endsection

@section('body')
@parent


@section('content')
{{-- Las dos funciones siguientes se utilizan para mostrar el monto de la especialidad (segun corresponda) en el modal para inscribir a un alumno --}}
<script>
  var valido = false;
  function obtenerMonto(id){
    valido = !valido;
    if (valido == true){
      document.getElementById("montoEspecialidad"+id).style.display = 'block';
    }else{
      document.getElementById("montoEspecialidad"+id).style.display = 'none';
    }
  }
</script>
<script>
  function actualizarMonto(id){
    const especialidad = $('#especialidad'+id).val();
    const monto = $('#optionEspecialidad'+especialidad).val();
    const html = '<p class="text-muted" style="margin-top:40;"><h5>Monto <b><span class="badge bg-warning"> $'+monto+'</span></b></h5></p>'
    $('#montoEspecialidad'+id).html(html);
  }
</script>

{{-- La funcion siguiente se utiliza para consultar la deuda de un cliente al intentar registrar un pago de su cuota --}}
{{-- <script>
  function consultarDeuda(id){
    $.ajax({
      url:"/clientes/deuda/consultar",
      method:"GET",
      data:{id:id,},
      success:function(result)
      {
        console.log(result);
        if (result > 0){
          const html = '<p><h5>El cliente registra una deuda de </b><span class="badge bg-danger">$'+result+'</span></h5></p>';
          $('#montoDeudaCliente'+id).html(html);
        }else{
          const html = '<pc lass="text-muted">El cliente no registra deudas</p>';
          $('#montoDeudaCliente'+id).html(html);
        }
      }
  })
  }

</script> --}}
    
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
                            @if ($cliente->estado->id === 4)
                            <a role="button" class="" data-toggle="modal" href="#" data-target="#modal-default-pagarDeuda-{{ $cliente->id }}" title="Saldar deuda">
                              <i class="fal fa-badge-dollar"></i>
                            </a>
                            @endif
                            <a title="Editar inscripto" href="/clientes/{{ $cliente->id }}/edit/{{ $gimnasio->id }}"><i class="fal fa-pencil-alt"></i></a>
                            
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
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Realizar inscripción de <b>{{ $cliente->nombre }} {{ $cliente->apellido }}</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                            
                              <div class="modal-body">
                                <div class="form-group row">
                                  <div class="form-group col-md-6">
                                    <label for="especialidad" class="col-form-label text-md-right">Especialidad</label>
                                    <select onchange="actualizarMonto('{{ $cliente->id }}')" name="especialidad" id="especialidad{{ $cliente->id }}" class="form-control select2 select2-hidden-accessible @error('especialidad') is-invalid @enderror" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                      <option>Seleccione especialidad</option>
                                      @foreach ($gimnasio->especialidades as $especialidad)
                                          <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                                      @endforeach
                                      @foreach ($gimnasio->especialidades as $especialidad)
                                      <input type="hidden" id="optionEspecialidad{{$especialidad->id}}" value="{{ $especialidad->monto }}">
                                      @endforeach
                                    </select>
                                    @error('especialidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                  <label class="col-form-label text-md-right"></label>
                                  <div class="" style="display:none;" id="montoEspecialidad{{ $cliente->id }}">
                                    
                                  </div>
                              </div>
                                
                                </div>

                                <div class="form-group row">
                                  <div class="form-group col-md-3">
                                    <label for="monto" class="col-form-label text-md-right">Monto</label>
                                    <input id="monto{{$cliente->id}}" type="number" class="form-control @error('monto') is-invalid @enderror" name="monto" step="0.01" value="{{ old('monto') }}" placeholder="$" min="1" pattern="^[0-9]+" required>
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
                                    <textarea id="detalle{{$cliente->id}}" class="form-control  @error('detalle') is-invalid @enderror" cols="45" rows="2" name="detalle" value="{{ old('detalle') }}" placeholder="Ingrese la descripción">{{ old('detalle') }}</textarea>
                                    @error('detalle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" name="cuota" class="custom-control-input" id="customSwitch1{{$cliente->id}}" value="1" onchange="obtenerMonto('{{ $cliente->id }}')" id="toggle{{ $cliente->id }}">
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
                              {{-- <div class="form-group row">
                                <p><h5>Monto de <b>{{ $cliente->especialidad->nombre }} </b><span class="badge bg-warning">${{ $cliente->especialidad->monto }}</span></h5></p>
                              </div> --}}
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
                      </div>

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
                              <div class="row">
                              <div class="">
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
                                          El cliente registra una deuda de </b><span class="badge bg-danger">${{ $cliente->getDeuda() }}</span>
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