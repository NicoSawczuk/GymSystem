@extends('theme.admin-lte.template')

@section('title') Agregar montos mensuales @endsection

@section('body')
@section('sidebarMenu')



@endsection

<body class="container">
    <div class=" mt-4 row justify-content-center">
        <div class="col-md-8">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fal fa-edit"></i> Agregar montos mensuales</h3>

                    <div class="card-tools">
                        <div class="float-right">
                            <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <form method="POST" action="{{route('montosMensuales.store')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="form-group col-md-3">
                                <label for="year" class="col-form-label text-md-right">Año</label>
                                <input id="year" type="number" class="form-control" name="year"
                                    value="{{ old('year') }}" placeholder="Ingrese el año" pattern="^[0-9]+" required>
                                <span class="invalid-feedback" role="alert" id="alertaYear" style="display:none;">

                                </span>
                            </div>

                        </div>
                        <div id="contenedor">

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

        //Seteamos el min del año
        $('#year').attr({
            "min" : parseInt(moment().format("Y"))
        });

    });
</script>
<script>
    $('#year').focusout(function(){
        $('#contenedor').html('');
        $('#alertaYear').css({
            'display': 'none'
        })

        const yearInput = parseInt($('#year').val());
        
        if (yearInput == parseInt(moment().format("Y"))){
            const month = parseInt(moment().format("M"));
            const year = parseInt(moment().format("Y"));
            for (let i = month; i <= 12; i++) {
                
                $('#contenedor').append(
                    '<div class="form-group row">'+
                        '<div class="form-group col-md-4">'+
                            '<label for="'+moment(String(i)).format("MMMM")+'" class=" col-form-label text-md-right">'+moment(String(i)).format("MMMM")+'</label>'+
                            '<input id="'+moment(String(i)).format("MMMM")+'" type="text"'+
                                'class="form-control" name="'+i+'" '+
                                'value="'+i+'" required disabled>'+
                        '</div>'+

                    ' <div class="form-group col-md-3">'+
                            '<label for="monto'+i+'" class="col-form-label text-md-right">Monto</label>'+
                            '<input id="monto'+i+'" type="number"'+
                                'class="form-control " name="'+i+'" '+
                                'value="" placeholder="Ingrese el monto de '+moment(String(i)).format("MMMM")+'" min="1" '+
                                'pattern="^[0-9]+" required>'+
                        '</div>'+

                    '</div>'
                )
            }
            }else if (yearInput >= parseInt(moment().format("Y"))){
                const month = 1;
                const year = parseInt(moment().format("Y"));
                for (let i = month; i <= 12; i++) {
                    
                    $('#contenedor').append(
                        '<div class="form-group row">'+
                            '<div class="form-group col-md-4">'+
                                '<label for="'+moment(String(i)).format("MMMM")+'" class=" col-form-label text-md-right">'+moment(String(i)).format("MMMM")+'</label>'+
                                '<input id="'+moment(String(i)).format("MMMM")+'" type="text"'+
                                    'class="form-control" name="'+i+'" '+
                                    'value="'+i+'" required disabled>'+
                            '</div>'+

                        ' <div class="form-group col-md-3">'+
                                '<label for="monto'+i+'" class="col-form-label text-md-right">Monto</label>'+
                                '<input id="monto'+i+'" type="number"'+
                                    'class="form-control " name="'+i+'" '+
                                    'value="" placeholder="Ingrese el monto de '+moment(String(i)).format("MMMM")+'" min="1" '+
                                    'pattern="^[0-9]+" required>'+
                            '</div>'+

                        '</div>'
                    )
                }
            }else{
                $('#alertaYear').css({
                    'display': 'block'
                })
                $('#alertaYear').html('<strong >El año no puede ser menor al actual</strong>')
            }
    })
</script>

@endsection
@include('theme.admin-lte.scripts')