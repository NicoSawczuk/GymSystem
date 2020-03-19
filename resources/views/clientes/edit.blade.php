@extends('theme.admin-lte.template')

@section('title') Editar un cliente @endsection

@section('body')
@parent
@section('nombreGimnasio')
    <strong>{{ $gimnasio->nombre }}</strong>
@endsection

@section('content')
@section('contentHeader') Editar {{ $cliente->nombre }} {{ $cliente->apellido }}  @endsection
<body class="container">
    <form method="POST" action="/clientes/{{ $cliente->id }}">
    @csrf
    @method('PATCH')
    <input type="hidden" name="gimnasio" value="{{ $gimnasio->id }}">
    <div class="">
        <div class="">
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
                                    <input id="nombre" type="text" class="form-control  @error('nombre') is-invalid @enderror" name="nombre" value="{{ $cliente->nombre }}" placeholder="Ingrese el nombre">
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="apellido" class=" col-form-label text-md-right">Apellido</label>
                                    <input id="apellido" type="text" class="form-control  @error('apellido') is-invalid @enderror" name="apellido" value="{{ $cliente->apellido }}" placeholder="Ingrese el apellido">
                                    @error('apellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="sexo" class=" col-form-label text-md-right">Sexo</label>
                                    <select name="sexo" id="sexo" class="form-control @error('sexo') is-invalid @enderror">
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="FEMENINO">Femenino</option>
                                        <option value="OTRO">Otro</option>
                                    </select>
                                    @error('sexo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-4">
                                    <label for="email" class="col-form-label text-md-right">Correo electrónico</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $cliente->email }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="telefono" class=" col-form-label text-md-right">Teléfono</label>
                                    <input id="phone-mask" type="text" class="form-control  @error('telefono') is-invalid @enderror" name="telefono" value="{{ $cliente->telefono }}" placeholder="Ingrese el telefono" 
                                    data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                                    <small class="form-text text-muted">Cod. de área + Número</small>
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="cuil" class=" col-form-label text-md-right">CUIL</label>
                                    <input id="cuil-mask" type="text" class="form-control  @error('cuil') is-invalid @enderror" name="cuil" value="{{ $cliente->cuil }}" placeholder="Ingrese el cuil" 
                                    data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                                    @error('cuil')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-4">
                                    <label for="fecha_nacimiento" class="col-form-label text-md-right">Fecha de nacimiento</label>
                                    <input type="date" id="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" value="{{ $cliente->fecha_nacimiento }}" data-mask="" im-insert="false" placeholder="dd/mm/yyyy" name="fecha_nacimiento" required>

                                    @error('fecha_nacimiento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="altura" class="col-form-label text-md-right">Altura</label>
                                    <input id="altura" type="number" class="form-control @error('altura') is-invalid @enderror" name="altura" step="0.01" value="{{ $cliente->altura }}" placeholder="En m" min="1" pattern="^[0-9]+">
    
                                    @error('altura')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group col-md-2">
                                    <label for="peso" class="col-form-label text-md-right">Peso</label>
                                    <input id="peso" type="number" class="form-control @error('peso') is-invalid @enderror" name="peso" step="0.01" value="{{ $cliente->peso }}" placeholder="En Kg" min="1" pattern="^[0-9]+">
    
                                    @error('peso')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-4">
                                    <label for="ocupacion" class=" col-form-label text-md-right">Ocupación</label>
                                    <input id="ocupacion" type="text" class="form-control  @error('ocupacion') is-invalid @enderror" name="ocupacion" value="{{ $cliente->ocupacion }}" placeholder="Ingrese la ocupación">
                                    @error('ocupacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <a href="/clientes/administrar/{{ $gimnasio->id }}">
                                <button type="button" class="btn btn-default"><i class="fal fa-times"></i> Cancelar</button>
                            </a>
                            <button type="submit" class="btn btn-primary "><i class="fal fa-check"></i> Guardar</button>
                        </div>
                    </div>
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
        $('#cuil-mask').mask('00-00.000.000-0');
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
