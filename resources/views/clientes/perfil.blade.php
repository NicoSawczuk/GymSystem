@extends('theme.admin-lte.template')

@section('title') Perfil de usuario @endsection

@section('body')
@parent


@section('content')

    
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