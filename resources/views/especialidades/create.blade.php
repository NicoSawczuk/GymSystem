@extends('theme.admin-lte.template')

@section('title') Agregar una especialidad @endsection

@section('body')
<body class="container">
    <div class=" mt-4 row justify-content-center">
        <div class="col-md-8">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title">Agregar una especialidad</h3>
        
                    <div class="card-tools">
                      <div class="float-right">
                          <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                      </div>
                    </div>
                  </div>

                    
                    <div class="card-body">
                        <form method="POST" action="/especialidades/create">
                            @csrf
                            
                            <div class="form-group row">
                                <div class="form-group col-md-3">
                                    <label for="nombre" class=" col-form-label text-md-right">Nombre</label>
                                    <input id="nombre" type="text" class="form-control  @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese el nombre">
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-5">
                                    <label for="descripcion" class=" col-form-label text-md-right">Descripción</label>
                                    <input id="descripcion" type="textarea" class="form-control  @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" placeholder="Ingrese la descripción">
                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="monto" class="col-form-label text-md-right">Monto</label>
                                    <input id="monto" type="number" class="form-control @error('monto') is-invalid @enderror" name="monto" value="{{ old('monto') }}" placeholder="Ingrese el monto">
    
                                    @error('monto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                

                            </div>
                    </div>
                    <div class="card-footer float">
                        <div class="float-right">
                            <a href="/especialidades/administrar">
                                <button type="button" class="btn btn-default"><i class="fal fa-times"></i> Cancelar</button>
                            </a>
                            <button type="submit" class="btn btn-primary "><i class="fal fa-check"></i> Guardar</button>
                        </div>
                    </div>
        </div>
    </form>
    </div>
    
</body>



@endsection
@include('theme.admin-lte.scripts')
