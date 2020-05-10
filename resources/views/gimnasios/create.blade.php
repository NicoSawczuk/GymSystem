@extends('theme.admin-lte.template')

@section('title') Agregar un gimnasio @endsection

@section('body')
@section('sidebarMenu')



@endsection

<body class="container">
    <div class=" mt-4 row justify-content-center">
        <div class="col-md-8">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fal fa-edit"></i> Agregar un gimnasio</h3>

                    <div class="card-tools">
                        <div class="float-right">
                            <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <form method="POST" action="/gimnasios/{{ Auth::user()->id }}/create">
                        @csrf

                        <div class="form-group row">

                            <div class="form-group col-md-3">
                                <label for="pais">Pais</label>
                                <select class="form-control @error('pais') is-invalid @enderror" id="pais" name="pais"
                                    required>
                                    <option value="">Seleccione</option>
                                    @forelse ($paises as $pais)
                                    <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                                    @empty
                                    <p>No hay paises cargados</p>
                                    @endforelse
                                    <option></option>
                                </select>
                                @error('pais')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="provincia">Provincia</label>
                                <select class="form-control @error('provincia') is-invalid @enderror" id="provincia"
                                    name="provincia" required>
                                    <option value="">Seleccione</option>
                                </select>
                                @error('provincia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="ciudad">Ciudad</label>
                                <select class="form-control @error('ciudad') is-invalid @enderror" id="ciudad"
                                    name="ciudad" required>
                                    <option value="">Seleccione</option>
                                </select>
                                @error('ciudad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>


                        <div class="form-group row">
                            <div class="form-group col-md-4">
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

                            <div class="form-group col-md-4">
                                <label for="especialidades" class=" col-form-label text-md-right">Especialidades</label>
                                <label for="agregar_especialidades">
                                    <a role="button" type="submit" onclick="modalAddEspe()"
                                        title="Agregar especialidad"><i class="fal fa-plus-circle fa-md"></i></a>
                                </label>
                                <select class="select2bs4 select2-hidden-accessible" multiple=""
                                    data-placeholder="Seleccione la especialidad" style="width: 100%;"
                                    aria-hidden="true" name="especialidades[]" id="selectEspecialidad" required>
                                    @foreach ($especialidades as $especialidad)
                                    <option value="{{$especialidad->id}}">{{ $especialidad->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('especialidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">

                            <div class="form-group col-md-4">
                                <label for="email" class="col-form-label text-md-right">Correo electrónico</label>
                                <input id="email" type="email"
                                    class="form-control  @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" placeholder="Ingrese el email" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="calle" class="col-form-label text-md-right">Calle</label>
                                <input id="calle" type="text" class="form-control  @error('calle') is-invalid @enderror"
                                    name="calle" value="{{ old('calle') }}" placeholder="Ingrese la calle" required>
                                @error('calle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-2">
                                <label for="altura" class="col-form-label text-md-right">Altura</label>
                                <input id="altura" type="number"
                                    class="form-control @error('altura') is-invalid @enderror" name="altura"
                                    value="{{ old('altura') }}" placeholder="Ingrese la altura" min="1"
                                    pattern="^[0-9]+" required>

                                @error('altura')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer float">
                    <div class="float-right">
                        <a href="/gimnasios/administrar">
                            <button type="button" class="btn btn-default"><i class="fal fa-times"></i> Cancelar</button>
                        </a>
                        <button type="submit" class="btn btn-primary "><i class="fal fa-check"></i> Guardar</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        {{-- MODAL AGREGAR ESPECIALIDAD --}}
        <div class="modal fade" id="modal-default-add-espe">
            <div class="modal-dialog">
                <form method="post" id="sample_form" action="{{ route('especialidades.ajax_create') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar especialidad</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="form-group col-md-8">
                                    <label for="nombre" class=" col-form-label text-md-right">Nombre</label>
                                    <input id="nombreEspe" type="text"
                                        class="form-control  @error('nombre') is-invalid @enderror" name="nombreEspe"
                                        value="{{ old('nombre') }}" placeholder="Ingrese el nombre" required>
                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="monto" class="col-form-label text-md-right">Monto</label>
                                    <input id="montoEspe" type="number"
                                        class="form-control @error('monto') is-invalid @enderror" name="montoEspe"
                                        value="{{ old('monto') }}" placeholder="Ingrese el monto" min="1"
                                        pattern="^[0-9]+" required>

                                    @error('monto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-12">
                                    <label for="descripcion" class=" col-form-label text-md-right">Descripción</label>
                                    <textarea id="descripcionEspe"
                                        class="form-control  @error('descripcion') is-invalid @enderror" rows="3"
                                        name="descripcionEspe" value="{{ old('descripcion') }}"
                                        placeholder="Ingrese la descripción"
                                        required>{{ old('descripcion') }}</textarea>
                                    @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                        class="fal fa-times"></i> Cancelar</button>
                                <a role="button" onclick="agregarEspecialidad()" class="btn btn-primary text-white"><i
                                        class="fal fa-check"></i> Confirmar</a>
                            </div>

                        </div>
                        <!-- /.modal-content -->
                </form>
            </div>
            <!-- /.modal-dialog -->
        </div>


        <script>
            $(document).ready(function() {
        document.getElementById("provincia").disabled = true;
        document.getElementById("ciudad").disabled = true;
    });
        </script>


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

        <script>
            function modalAddEspe(){
            $('#modal-default-add-espe').modal({
                show: true
            });
        }
        </script>


        <script>
            $(function () {
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    });

        </script>

<script>
    function agregarEspecialidad(){       
        var token = '{{csrf_token()}}';
        var nombre = $('#nombreEspe').val();
        var monto = $('#montoEspe').val();
        var descripcion = $('#descripcionEspe').val();
        $.ajax({
              url:"{{ route('especialidades.ajax_create') }}",
              method:"POST",
              data: {_token:token, nombre:nombre, monto:monto, descripcion:descripcion},
              success:function(result){
                if (result === '1'){
                    $('#modal-default-add-espe').modal('hide');
                    $('#nombreEspe').val('');
                    $('#montoEspe').val('');
                    $('#descripcionEspe').val('');
                    Notiflix.Notify.Success('Especialidad agregada con éxito');
                    $("#selectEspecialidad").append(new Option(String(nombre), '4'));
                }else{
                    var errores ="";
                    result.forEach(element => {
                        errores += element+'\n';
                    });
                    Notiflix.Notify.Failure(errores);
                }
            }
        })

    }
</script>

</body>



@endsection
@include('theme.admin-lte.scripts')