@extends('theme.admin-lte.template')

@section('title') Perfil de usuario @endsection

@section('body')
@parent


@section('content')



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

    
@section('contentHeader') Perfil del cliente @endsection
<body class="container-fluid">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-3">
      
                  <!-- Profile Image -->
                  <div class="card card-teal card-outline">
                    <div class="card-body box-profile">
                      <div class="text-center">
                        @if ($cliente->sexo === 'MASCULINO')
                            <span style="font-size: 7em; color: #3c8dbc;">
                                <i class="fas fa-user-circle"></i>
                            </span>
                        @else
                            <span style="font-size: 7em; color: #e83e8c;">
                                <i class="fas fa-user-circle"></i>
                            </span>
                        @endif
                      </div>
      
                      <h3 class="profile-username text-center">{{ $cliente->nombre }} {{ $cliente->apellido }}</h3>
      
                      <p class="text-muted text-center">{{ $cliente->ocupacion }}</p>
      
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Gimnasio</b> <a class="float-right"><span class="badge badge-pill bg-light">{{ $cliente->gimnasio->nombre }}</span></a>
                        </li>
                        @isset($cliente->especialidad)
                        <li class="list-group-item">
                          <b>Especialidad</b> <a class="float-right"><span class="badge badge-pill bg-light">{{ $cliente->especialidad->nombre }}</span></a>
                        </li>
                        @endisset
                        <li class="list-group-item">
                          <b>Estado</b> <a class="float-right">
                            <span class="badge badge-pill" style="background-color: {{$cliente->estado->color}}; color: white;">{{ $cliente->estado->nombre }}</span>
                            @if ($cliente->getCuotaVencida() == '1')
                                <span class="badge badge-pill bg-Lightblue" >Cuota vencida</span>
                            @endif
                            </a>
                        </li>
                      </ul>
      
                      <a href="/clientes/{{ $cliente->id }}/enviar_email" class="btn bg-teal btn-block"><b>Enviar E-mail</b></a>
                      @if ($cliente->activo == 1)
                      <a href="#" role="button" onclick="modalBaja()" class="btn bg-maroon btn-block"><b>Dar de baja</b></a>
                      @else
                      <a href="#" role="button" onclick="modalAlta('{{$gimnasio->id}}','{{$cliente->id}}','{{$cliente->nombre}}','{{$cliente->apellido}}','{{$cliente->getDeuda()}}')" class="btn bg-olive btn-block"><b>Dar de alta</b></a>
                      @endif
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
      
                  @if($cliente->getUltimasTresCuotas()->count() != 0)
                  <!-- About Me Box -->
                  <div class="card card-teal">
                    <div class="card-header">
                      <h3 class="card-title">Últimos pagos ({{ $cliente->getUltimasTresCuotas()->count() }} de {{ $cliente->cuotas->count() }})</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        

                    
                        @foreach ($cliente->getUltimasTresCuotas() as $cuota)
                        <table class="table">
                            <tbody>
                            <head>
                                <strong><i class="fas fa-usd-circle"></i> 
                                Del ({{ \Carbon\Carbon::create($cuota->fecha_pago)->format('d/m')}}) al 
                                ({{ \Carbon\Carbon::create($cuota->fecha_pago)->addMonth()->format('d/m')}})
                                </strong>
                            </title>
                            <tr>
                                <th style="width:60%; text-align: left; margin-bottom: 1%; margin-top: 1%" class="text-left text-muted">Monto a pagar:</th>
                                <td class="text-right">${{ $cuota->monto_cuota }}</td>
                            </tr>
                            <tr>
                                <th style="width:60%; text-align: left; margin-bottom: 1%; margin-top: 1%" class="text-left text-muted">Monto pagado:</th>
                                <td class="text-right">${{ $cuota->monto_pagado }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    @endforeach
                      
                    </div>
                    <!-- /.card-body -->
                  </div>
                  @else
                  <div class="callout" style="border-left-color: #20c997;">
                    <h5>Pagos</h5>
  
                    <p>El cliente aún no registra pagos</p>
                  </div>
                  @endif
                  <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                  <div class="card">
                    <div class="card-header p-2">
                      <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#infoPersonal" data-toggle="tab">Informacion personal</a></li>
                        <li class="nav-item"><a class="nav-link" href="#cuotas" data-toggle="tab">Cuotas</a></li>
                      </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="active tab-pane" id="infoPersonal">

                            <div class="text-muted" style="font-family: 'Open Sans', serif;">GENERAL</div>
                            <hr style="margin-bottom: 1%; margin-top: 0%">
                            <dl class="row" style="margin-left: 1%">
                                <dt class="col-sm-3">Nombre</dt>
                                <dd class="col-sm-8 text-muted">{{ $cliente->nombre }}</dd>
                            </dl>
                            <dl class="row" style="margin-left: 1%">
                                <dt class="col-sm-3">Apellido</dt>
                                <dd class="col-sm-8 text-muted">{{ $cliente->apellido }}</dd>
                            </dl>
                            <dl class="row" style="margin-left: 1%">
                                <dt class="col-sm-3">Fecha de nacimiento</dt>
                                <dd class="col-sm-8 text-muted">{{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m/Y')}} ({{ $cliente->getEdad() }} años)</dd>
                            </dl>
                            <dl class="row" style="margin-left: 1%">
                                <dt class="col-sm-3">Ocupación</dt>
                                <dd class="col-sm-8 text-muted">{{ $cliente->ocupacion }}</dd>
                            </dl>

                            <div class="text-muted" style="font-family: 'Open Sans', serif;">ENTRENAMIENTO</div>
                            <hr style="margin-bottom: 1%; margin-top: 0%">
                            <dl class="row" style="margin-left: 1%">
                                <dt class="col-sm-3">Sexo</dt>
                                <dd class="col-sm-8 text-muted">{{ $cliente->sexo }}</dd>
                            </dl>
                            <dl class="row" style="margin-left: 1%">
                                <dt class="col-sm-3">Altura</dt>
                                <dd class="col-sm-8 text-muted">{{ $cliente->altura }}m</dd>
                            </dl>
                            <dl class="row" style="margin-left: 1%">
                                <dt class="col-sm-3">Peso</dt>
                                <dd class="col-sm-8 text-muted">{{ $cliente->peso }}Kg</dd>
                            </dl>

                            @isset($cliente->especialidad)
                            <div class="text-muted" style="font-family: 'Open Sans', serif;">INSCRIPCIÓN</div>
                            <hr style="margin-bottom: 1%; margin-top: 0%">
                            <dl class="row" style="margin-left: 1%">
                                <dt class="col-sm-3">Fecha</dt>
                                <dd class="col-sm-8 text-muted">{{ \Carbon\Carbon::parse($cliente->getUltimaInscripcion()->fecha_inscripcion)->format('d/m/Y')}}</dd>
                            </dl>
                            <dl class="row" style="margin-left: 1%">
                                <dt class="col-sm-3">Estado</dt>
                                @if ($cliente->getUltimaInscripcion()->activo === 1)
                                    <dd class="col-sm-8 text-muted">Activa</dd>
                                @else
                                    <dd class="col-sm-8 text-muted">Inactiva</dd>
                                @endif
                            </dl>
                            @isset($cliente->getUltimaInscripcion()->detalle)
                            <dl class="row" style="margin-left: 1%">
                                <dt class="col-sm-3">Detalle</dt>
                                <dd class="col-sm-8 text-muted">{{ $cliente->getUltimaInscripcion()->detalle }}</dd>
                            </dl>
                            @endisset
                            @endisset
                            <div class="text-muted" style="font-family: 'Open Sans', serif;">CONTACTO</div>
                            <hr style="margin-bottom: 1%; margin-top: 0%">
                            <dl class="row" style="margin-left: 1%">
                                <dt class="col-sm-3">Teléfono</dt>
                                <dd class="col-sm-8 text-muted">{{ $cliente->telefono }}</dd>
                            </dl>
                            <dl class="row" style="margin-left: 1%">
                                <dt class="col-sm-3">Correo electrónico</dt>
                                <dd class="col-sm-8 text-muted">{{ $cliente->email }}</dd>
                            </dl>
                            

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="cuotas">
                        </div>
                        </div>
                        <!-- /.tab-pane -->
                      </div>
                      <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                  </div>
                  <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->


          {{-- MODAL BAJA --}}
          <div class="modal fade" id="modal-default-baja">
            <div class="modal-dialog">
              <form method="POST" action="/clientes/{{$cliente->id}}/baja">
                @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"> Dar de baja a {{$cliente->nombre}} {{$cliente->apellido}}</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              
                <div class="modal-body">
                  <div class="callout callout-warning">
                    <h5>Atención</h5>
  
                    <p>Esta a punto de dar de baja a {{$cliente->nombre}} {{$cliente->apellido}}, con esta acción no se podrán registrar pagos del cliente. Además, el sistema no controlará los pagos de sus cuotas</p>
                  </div>

                  @if ($cliente->getDeuda() > 0)
                    <div class="callout callout-danger">
                      <h5>Deudas</h5>
    
                      <p>Ten en cuenta que el cliente tiene una deuda de <b>${{$cliente->getDeuda()}}</b>. Si no quieres saldar esa deuda, al momento de darlo de alta la podrás saldar</p>
                    </div>
                  @endif

                  <div class="form-group">
                    <label for="detalle" class=" col-form-label text-md-right">Detalle</label>
                    <textarea id="detalle" class="form-control  @error('detalle') is-invalid @enderror" rows="3" name="detalle" value="{{ old('detalle') }}" placeholder="Ingrese el detalle de la baja" required>{{ old('detalle') }}</textarea>
                    @error('detalle')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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

          {{-- MODAL INSCRIBIR --}}
          <div class="modal fade" id="modal-default-alta">
            <div class="modal-dialog">
              <form method="POST" action="" id="InscripcionForm">
                @csrf
                @method('POST')
                <input type="hidden" name="gimnasio" id="gimnasio">
                <input type="hidden" name="cliente" id="cliente">
                <input type="hidden" name="deuda_anterior" id="deuda_anterior">
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
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
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
                            <p class="text-muted" >El cliente no registra deudas</p>
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
                      <select name="especialidad" id="especialidad" onchange="cargarMonto()" class="form-control select2 select2-hidden-accessible @error('especialidad') is-invalid @enderror" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                        <option value="" selected disabled>Seleccione especialidad</option>
                        @foreach ($gimnasio->especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                        @endforeach
                      </select>
                      @foreach ($gimnasio->especialidades as $especialidad)
                          <input type="hidden" id="montoEspecialidad{{$especialidad->id}}" value="{{ $especialidad->monto }}">
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
                      <input id="monto" type="number" class="form-control @error('monto') is-invalid @enderror" name="monto" step="0.01" value="{{ old('monto') }}" placeholder="$" min="1" pattern="^[0-9]+" required>
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
                      <textarea id="detalle" class="form-control  @error('detalle') is-invalid @enderror" cols="45" rows="2" name="detalle" value="{{ old('detalle') }}" placeholder="Ingrese la descripción">{{ old('detalle') }}</textarea>
                      @error('detalle')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="cuota" class="custom-control-input" id="customSwitch1" value="0" id="toggle">
                    <label class="custom-control-label" for="customSwitch1">La inscripción forma parte de la cuota</label>
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
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    })
  });
</script>

<script>
  function modalBaja(){
    $('#modal-default-baja').modal({
        show: true
    });
  }
</script>

<script>
  function modalAlta(gimId, clieId, clieNombre, clieApellido, clieDeuda){
    $('#modal-default-alta').modal({
        show: true
    });
    $("#InscripcionForm").attr('action', '/inscripcion/create/'+clieId+'');
    $('#gimnasio').val(gimId);
    $('#cliente').val(clieId);
    $('#deuda_anterior').val(clieDeuda);

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