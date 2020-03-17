@extends('theme.admin-lte.template')

@section('title') Agregar un cliente @endsection

@section('body')
@parent
@section('nombreGimnasio')
    <strong>{{ $gimnasio->nombre }}</strong>
@endsection

@section('content')
@section('contentHeader') Agregar un nuevo cliente  @endsection
<body class="container">
    <form method="POST" action="/clientes/create/{{ $gimnasio->id }}">
    @csrf
    <div class="mt-4 row">
        <div class="col-md-7">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fal fa-edit"></i> Datos personales</h3>
                    <div class="card-tools">
                      <div class="float-right">
                          <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                      </div>
                    </div>
                </div>
                    <div class="card-body">
                            <div class="form-group row">
                                <div class="form-group col-md-4">
                                    <label for="nombre" class=" col-form-label text-md-right">Nombre</label>
                                    <input id="nombre" type="text" class="form-control  @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese el nombre">
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="apellido" class=" col-form-label text-md-right">Apellido</label>
                                    <input id="apellido" type="text" class="form-control  @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" placeholder="Ingrese el apellido">
                                    @error('apellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-4">
                                    <label for="email" class="col-form-label text-md-right">Correo electrónico</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="telefono" class=" col-form-label text-md-right">Teléfono</label>
                                    <input id="phone-mask" type="text" class="form-control  @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" placeholder="Ingrese el telefono" 
                                    data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                                    <small class="form-text text-muted">Cod. de área + Número</small>
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-4">
                                    <label for="fecha_nacimiento" class="col-form-label text-md-right">Fecha de nacimiento</label>
                                    <input type="date" id="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" value="{{ old('fecha_nacimiento') }}" data-mask="" im-insert="false" placeholder="dd/mm/yyyy" name="fecha_nacimiento" required>

                                    @error('fecha_nacimiento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="altura" class="col-form-label text-md-right">Altura</label>
                                    <input id="altura" type="number" class="form-control @error('altura') is-invalid @enderror" name="altura" step="0.01" value="{{ old('altura') }}" placeholder="En m">
    
                                    @error('altura')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group col-md-2">
                                    <label for="peso" class="col-form-label text-md-right">Peso</label>
                                    <input id="peso" type="number" class="form-control @error('peso') is-invalid @enderror" name="peso" step="0.01" value="{{ old('peso') }}" placeholder="En Kg">
    
                                    @error('peso')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card card-teal card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fal fa-edit"></i> Datos deportivos</h3>
    
                <div class="card-tools">
                  <div class="float-right">
                      <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                  </div>
                </div>
              </div>

                
                <div class="card-body">                        
                        <div class="form-group row">
                            <div class="form-group col-md-5">
                                <label for="gimnasio" class=" col-form-label text-md-right">Gimnasio</label>
                                
                                <select id="select2" class="form-control select2 select2-hidden-accessible" style="width: 100%;" aria-hidden="true" name="gimnasio" disabled>
                                    <option value="{{$gimnasio->id}}" selected>{{ $gimnasio->nombre }}</option>
                                </select>
                                <input type="hidden" name="gimnasio" value="{{ $gimnasio->id }}">
                                
                                @error('gimnasio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-group col-md-5">
                                <label for="especialidad" class=" col-form-label text-md-right">Especialidad</label>
                                <select id="select2" class="form-control select2 select2-hidden-accessible" style="width: 100%;" aria-hidden="true" name="especialidad" required>
                                    @foreach ($gimnasio->especialidades as $especialidad)
                                    <option value="{{$especialidad->id}}">{{ $especialidad->nombre }}   </option>
                                    @endforeach
                                  </select>
                                  
                                @error('especialidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                </div>
    </div>

</div>

<div class="col col-md-12">
    <div class="float-right">
        <a href="/clientes/administrar">
            <button type="button" class="btn btn-default"><i class="fal fa-times"></i> Cancelar</button>
        </a>
        <button type="submit" class="btn btn-primary "><i class="fal fa-check"></i> Guardar</button>
    </div>
</div>

</form>

    <script>
    $(function () { 
      //Datemask dd/mm/yyyy
      $('#fecha_nacimiento').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
      })
  </script>
  <script>
      $(document).ready(function(){
        $('#phone-mask').mask('(0000) 15-000000');
      })
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
    
<script type="text/javascript">
    document.getElementById("fecha_nacimiento").max = new Date().toISOString().split("T")[0];
</script>


</body>
@endsection



@endsection
@include('theme.admin-lte.scripts')
