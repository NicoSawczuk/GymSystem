@extends('theme.admin-lte.template')

@section('title') Agregar una especialidad @endsection

@section('body')
@parent


@section('content')

@section('contentHeader') Agregar una especialidad @endsection

<body class="container-fluid">
    <div class="">
        <div class="">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fal fa-edit"></i> Datos de la especialidad</h3>

                    <div class="card-tools">
                        <div class="float-right">
                            <h5><i title="Ayuda" id="popover" class="fal fa-question-circle"
                                    data-content="Ingrese la información para agregar una nueva especialidad al sistema. Por favor lea atentamente lo que le solicita cada campo">
                                </i></h5>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <form method="POST" action="{{route('especialidades.store', [$gimnasio->id, $gimnasio->slug()])}}">
                        @csrf
                        <input type="hidden" value="{{ $gimnasio->id }}" name="gimnasio">
                        <div class="form-group row">
                            <div class="form-group col-md-3">
                                <label for="nombre" class=" col-form-label text-md-right">Nombre</label>
                                <input id="nombre" type="text"
                                    class="form-control  @error('nombre') is-invalid @enderror" name="nombre"
                                    value="{{ old('nombre') }}" placeholder="Ingrese el nombre" required>
                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-5">
                                <label for="descripcion" class=" col-form-label text-md-right">Descripción</label>
                                <textarea id="descripcion"
                                    class="form-control  @error('descripcion') is-invalid @enderror" rows="3"
                                    name="descripcion" value="{{ old('descripcion') }}"
                                    placeholder="Ingrese la descripción" required>{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-2">
                                <label for="monto" class="col-form-label text-md-right">Monto</label>
                                <input id="monto" type="number"
                                    class="form-control @error('monto') is-invalid @enderror" name="monto"
                                    value="{{ old('monto') }}" placeholder="Ingrese el monto" min="1" pattern="^[0-9]+"
                                    required>

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
                        <a href="javascript:history.back()">
                            <button type="button" class="btn btn-default"><i class="fal fa-times"></i> Cancelar</button>
                        </a>
                        <button type="submit" class="btn btn-primary "><i class="fal fa-check"></i> Guardar</button>
                    </div>
                </div>
            </div>
            </form>
        </div>

</body>

<script>
    $(function () {
        $('#popover').popover();
    })
</script>
@endsection

@endsection
@include('theme.admin-lte.scripts')