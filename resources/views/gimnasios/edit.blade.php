@extends('theme.admin-lte.template')

@section('title') Editar {{ $gimnasio->nombre }} @endsection

@section('body')

<body class="container">
    <div class=" mt-4 row justify-content-center">
        <div class="col-md-8">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fal fa-edit"></i> Editar <strong>{{ $gimnasio->nombre }}</strong>
                    </h3>

                    <div class="card-tools">
                        <div class="float-right">
                            <h5>
                                <i title="Ayuda" id="popover" class="fal fa-question-circle"
                                    data-content="Modifique la información de {{$gimnasio->nombre}} y también agregue o quite especialidades al mismo">
                                </i>
                            </h5>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <form method="POST" action="{{route('gimnasios.update', [$gimnasio->id, $gimnasio->slug()])}}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">

                            <div class="form-group col-md-3">
                                <label for="pais">Pais</label>
                                <select class="form-control @error('pais') is-invalid @enderror" id="pais" name="pais"
                                    required>
                                    <option value="{{ \App\Pais::where('nombre',$gimnasio->pais)->value('id') }}">
                                        {{ $gimnasio->pais }}</option>
                                    @forelse ($paises as $pais)
                                    @if ($pais->nombre != $gimnasio->pais)
                                    <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                                    @endif

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
                                    <option
                                        value="{{ \App\Provincia::where('nombre',$gimnasio->provincia)->value('id') }}">
                                        {{ $gimnasio->provincia }}</option>
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
                                    <option value="{{ \App\Ciudad::where('nombre',$gimnasio->ciudad)->value('id') }}">
                                        {{ $gimnasio->ciudad }}</option>
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
                                    value="{{ $gimnasio->nombre }}" placeholder="Ingrese el nombre" required>
                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group col-md-4">
                                <label for="especialidades" class=" col-form-label text-md-right">Especialidades</label>
                                <select
                                    class="select2bs4 select2-hidden-accessible  @error('especialidades') is-invalid @enderror @if (session('error_espe')) is-invalid @endif"
                                    multiple="" data-placeholder="Seleccione la especialidad" style="width: 100%;"
                                    aria-hidden="true" name="especialidades[]" required>
                                    @foreach ($especialidades as $especialidad)
                                    @if ($gimnasio->especialidades->contains('id',$especialidad->id))
                                    <option value="{{$especialidad->id}}" selected>{{ $especialidad->nombre }}</option>
                                    @else
                                    <option value="{{$especialidad->id}}">{{ $especialidad->nombre }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('especialidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @if (session('error_espe'))
                                <span class="" style="width: 100%; margin-top: .25rem; font-size: 80%; color: #dc3545"
                                    role="alert">
                                    <strong>{{ session('error_espe') }}</strong>
                                </span>
                                @endif
                            </div>



                        </div>
                        <div class="form-group row">

                            <div class="form-group col-md-4">
                                <label for="email" class="col-form-label text-md-right">Correo electrónico</label>
                                <input id="email" type="text" class="form-control  @error('email') is-invalid @enderror"
                                    name="email" value="{{ $gimnasio->email }}" placeholder="Ingrese el email" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="calle" class="col-form-label text-md-right">Calle</label>
                                <input id="calle" type="text" class="form-control  @error('calle') is-invalid @enderror"
                                    name="calle" value="{{ $gimnasio->calle }}" placeholder="Ingrese la calle" required>
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
                                    value="{{ $gimnasio->altura }}" placeholder="Ingrese la altura" min="1"
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


        {{-- <script>
        $(document).ready(function() {
        document.getElementById("provincia").disabled = true;
        document.getElementById("ciudad").disabled = true;
    });
    </script> --}}

        <script>
            $(function () {
            $('#popover').popover();
        })
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
            $(function () {
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    });

        </script>

</body>



@endsection
@include('theme.admin-lte.scripts')