@extends('theme.admin-lte.template')

@section('title') Home @endsection

@section('body')
    @parent
    @section('nombreGimnasio') <strong>{{ $gimnasio->nombre }}</strong> @endsection

    @section('usuario')
        {{ Auth::user()->name }} {{ Auth::user()->apellido }}
    @endsection


    @section('contentHeader')
        Pagina principal
    @endsection



    @section('content')
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{ $gimnasio->getInscriptos() }}</h3>
      
                      <h4>Inscriptos</h4>
                    </div>
                    <div class="icon">
                      <i class="fas fa-users"></i>
                    </div>
                    <a href="/clientes/administrar/inscripto/{{ $gimnasio->id }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>{{ $gimnasio->getEnRegla() }}<sup style="font-size: 20px"></sup></h3>
      
                      <h4>En regla</h4>
                    </div>
                    <div class="icon">
                      <i class="fas fa-calendar-check"></i>
                    </div>
                    <a href="/clientes/administrar/en_regla/{{ $gimnasio->id }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>{{ $gimnasio->getNoInscriptos() }}</h3>
      
                      <h4>No inscriptos</h4>
                    </div>
                    <div class="icon">
                      <i class="fas fa-calendar-exclamation"></i>
                    </div>
                    <a href="/clientes/administrar/no_inscripto/{{ $gimnasio->id }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>{{ $gimnasio->getEnDeuda() }}</h3>
      
                      <h4>En deuda</h4>
                    </div>
                    <div class="icon">
                      <i class="fas fa-calendar-times"></i>
                    </div>
                    <a href="/clientes/administrar/en_deuda/{{ $gimnasio->id }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>
    
        
    @endsection

@endsection

@include('theme.admin-lte.scripts')