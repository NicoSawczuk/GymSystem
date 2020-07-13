@extends('theme.admin-lte.template')

@section('title') Modificar código de descuento @endsection

@section('body')
@section('sidebarMenu')



@endsection

<body class="container">
    <div class=" mt-4 row justify-content-center">
        <div class="col-md-8">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fal fa-edit"></i> Modificar {{$codigo->codigo}}</h3>

                    <div class="card-tools">
                        <div class="float-right">
                            <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <form method="POST" action="{{route('descuentos.update',[$codigo->id, $codigo->slug()])}}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <div class="form-group col-md-4">
                                <label for="codigo" class=" col-form-label text-md-right">Código</label>
                                <input id="codigo" type="text"
                                    class="form-control  @error('codigo') is-invalid @enderror" name="codigo"
                                    value="{{ $codigo->codigo }}" placeholder="Ingrese el codigo">
                                @error('codigo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="porcentaje_descuento" class=" col-form-label text-md-right">Porcentaje
                                    descuento</label>
                                <input id="porcentaje_descuento" type="number"
                                    class="form-control  @error('porcentaje_descuento') is-invalid @enderror"
                                    name="porcentaje_descuento" value="{{ $codigo->porcentaje_descuento }}"
                                    placeholder="Ingrese el % descuento">
                                @error('porcentaje_descuento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label id="fecha_expiracionLabel" for="fecha_expiracion"
                                    class="col-form-label text-md-right">Fecha de
                                    expiración</label>
                                <input style="max-width: 80%" type="date" id="fecha_expiracion"
                                    class="form-control @error('fecha_expiracion') is-invalid @enderror"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                    value="{{ $codigo->fecha_expiracion }}" data-mask="" im-insert="false"
                                    placeholder="dd/mm/yyyy" name="fecha_expiracion" min="" required>

                                @error('fecha_expiracion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-5">
                                <label for="detalle" class=" col-form-label text-md-right">Detalle</label>
                                <textarea id="detalle" class="form-control  @error('detalle') is-invalid @enderror"
                                    rows="3" name="detalle" value="{{ $codigo->detalle }}"
                                    placeholder="Ingrese la descripción" required>{{ $codigo->detalle }}</textarea>
                                @error('detalle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer float">
                    <div class="float-right">
                        <a href="{{route('descuentos.administrar')}}">
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
    $(document).ready(function(){
        //Datemask dd/mm/yyyy
        $('#fecha_expiracion').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
        document.getElementById("fecha_expiracion").min = new Date().toISOString().split("T")[0];

        //Cargamos los dias
        $('#fecha_expiracionLabel').html('Fecha de expiración');
        var f = new Date().toISOString().split("T")[0];
        var fecha1 = moment(f);
        var fecha2 = moment($('#fecha_expiracion').val());
        $('#fecha_expiracionLabel').append(' ('+fecha2.diff(fecha1, 'days')+' días)');
    })
</script>
<script>
    $('#fecha_expiracion').change(function(){
        $('#fecha_expiracionLabel').html('Fecha de expiración');
        var f = new Date().toISOString().split("T")[0];
        var fecha1 = moment(f);
        var fecha2 = moment($('#fecha_expiracion').val());
        $('#fecha_expiracionLabel').append(' ('+fecha2.diff(fecha1, 'days')+' días)');
    })
</script>


@endsection
@include('theme.admin-lte.scripts')