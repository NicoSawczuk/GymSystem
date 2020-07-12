@extends('theme.admin-lte.template')

@section('title') Modificar monto mensual @endsection

@section('body')
@section('sidebarMenu')



@endsection

<body class="container">
    <div class=" mt-4 row justify-content-center">
        <div class="col-md-8">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fal fa-edit"></i> Modificar
                        <b>
                            {{$montoMensual->mes.'/'.$montoMensual->ano.' ($'.$montoMensual->monto.')'}}
                        </b>
                    </h3>

                    <div class="card-tools">
                        <div class="float-right">
                            <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <form method="POST"
                        action="{{route('montosMensuales.update',[$montoMensual->id, $montoMensual->slug()])}}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <div class="form-group col-md-3">
                                <label for="year" class="col-form-label text-md-right">Año</label>
                                <input id="year" type="number" class="form-control" name="year"
                                    value="{{ $montoMensual->ano }}" placeholder="Ingrese el año" pattern="^[0-9]+"
                                    required disabled>
                                <input type="hidden" name="ano" value="{{$montoMensual->ano}}">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-4">
                                <label for="" class=" col-form-label text-md-right" id="labelMes"></label>
                                <input id="" type="text" class="form-control" name="mes" value="{{$montoMensual->mes}}"
                                    required disabled>
                                <input type="hidden" name="mes" value="{{$montoMensual->mes}}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="monto" class="col-form-label text-md-right">Monto</label>
                                <input id="monto" type="number" class="form-control " name="monto"
                                    value="{{$montoMensual->monto}}" placeholder="Ingrese el monto de" min="1"
                                    pattern="^[0-9]+" required>
                            </div>

                        </div>
                </div>
                <div class="card-footer float">
                    <div class="float-right">
                        <a href="{{route('montosMensuales.administrar')}}">
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
    $( document ).ready(function() {
        const month = '{{$montoMensual->mes}}';
        $('#labelMes').html(moment(String(month)).format("MMMM"))        
    });
</script>


@endsection
@include('theme.admin-lte.scripts')