@extends('theme.admin-lte.template')

@section('title') Editar {{ $especialidad->nombre }} @endsection

@section('body')
@parent


@section('content')

@section('contentHeader') Editar especialidad @endsection

<body class="container">
    <div class="">
        <div class="">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fal fa-edit"></i> Datos de
                        <strong>{{ $especialidad->nombre }}</strong></h3>

                    <div class="card-tools">
                        <div class="float-right">
                            <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <form method="POST" action="{{route('especialidades.update', [$especialidad->id, $especialidad->slug()])}}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" value="{{ $gimnasio->id }}" name="gimnasio">
                        <div class="form-group row">
                            <div class="form-group col-md-3">
                                <label for="nombre" class=" col-form-label text-md-right">Nombre</label>
                                <input id="nombre" type="text"
                                    class="form-control  @error('nombre') is-invalid @enderror" name="nombre"
                                    value="{{ $especialidad->nombre }}" placeholder="Ingrese el nombre" required>
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
                                    name="descripcion" value="{{ $especialidad->descripcion }}"
                                    placeholder="Ingrese la descripción"
                                    required>{{ $especialidad->descripcion }}</textarea>
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
                                    value="{{ $especialidad->monto }}" placeholder="Ingrese el monto" min="1"
                                    pattern="^[0-9]+" required>

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


        {{-- <script>
        $(document).ready(function() {
        document.getElementById("provincia").disabled = true;
        document.getElementById("ciudad").disabled = true;
    });
    </script> --}}


        <script>
            $('#pais').change(function(){
            if($(this).val() != '')
            {
                $('#provincia')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Seleccione</option>')
                .val('')
                .prop('disabled', 'disabled');
                $('#ciudad')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Seleccione</option>')
                .val('')
                .prop('disabled', 'disabled');
            document.getElementById("provincia").disabled = false;
            var id = $('#pais').val();
            $.ajax({
                url:"/gimnasios/pais",
                method:"GET",
                dataType: 'json',
                data:{id:id,},
                success:function(result)
                {
                
                    result.forEach(element => {
                        $("#provincia").append('<option value="'+element[0]+'">'+element[1]+'</option>');
                    });

                }
            })
            }
        });
        </script>

        <script>
            $('#provincia').change(function(){
            if($(this).val() != ''  )
            {

                $('#ciudad')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Seleccione</option>')
                .val('')
                .prop('disabled', 'disabled');
            document.getElementById("ciudad").disabled = false;
            var id = $('#provincia').val();
            console.log(id);
            $.ajax({
                url:"/gimnasios/provincia",
                method:"GET",
                data:{id:id,},
                success:function(result)
                {
                console.log(result);
                    result.forEach(element => {
                        $("#ciudad").append('<option value="'+element[0]+'">'+element[1]+'</option>');
                    });

                }
            })
            }
        });
        </script>


</body>

@endsection

@endsection
@include('theme.admin-lte.scripts')