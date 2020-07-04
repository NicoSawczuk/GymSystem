@extends('theme.admin-lte.template')

@section('title') Configurar Reporte @endsection

@section('body')
@parent


@section('content')

<script>
    var valido = false;
    function mostrar_ocultar(){
      valido = !valido;
      if (valido == true){
        document.getElementById("detalle").style.display = 'block';
        customSwitch1.checked = true;
      }else{
        document.getElementById("detalle").style.display = 'none';
        customSwitch1.checked = false;
      }
    }
</script>




@section('contentHeader') Configurar los reportes de {{$gimnasio->nombre}} @endsection

<body class="container">

    <div class="card card-teal card-outline">
        <div class="card-header">
            <h3 class="card-title text-center"><i class="fal fa-edit"></i> Modificar la cabecera
            </h3>
            <div class="card-tools">
                <div class="float-right">
                    <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('reporte_configuracion.update',[$gimnasio->id, $gimnasio->slug()]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <center>
                    <div class="card text-center" style="max-width: 80%">
                        <div class="row">
                            <div class="col col-md-3 text-left">
                                <img src="" id="logo2" height="100px" width="100px" alt="Logo">

                            </div>
                            <div class="col col-md-6">
                                <div class="row justify-content-center">
                                    <b>
                                        <p id="titulo2" style="font-size: 160%;"></p>
                                    </b>
                                </div>
                                <div class="row justify-content-center">
                                    <p id="calle2"></p>
                                    <p id="altura2"> </p>
                                    <p id="ciudad2"></p>
                                    <p id="provincia2"></p>
                                    <p id="pais2"></p>
                                </div>
                                <div class="row justify-content-center">
                                    <p id="telefono2"></p>
                                </div>
                            </div>
                            <div class="col col-md-3 text-right">
                                <p id="fecha"></p>
                                <p id="autor"></p>
                            </div>
                        </div>
                    </div>
                </center>
                <br>
                <div class="form-group row">
                    <div class="form-group col-md-6">
                        <label for="titulo" class=" col-form-label text-md-right">Titulo</label>
                        <input id="titulo" type="text" class="form-control  @error('titulo') is-invalid @enderror"
                            name="titulo" value="" placeholder="Ingrese el titulo" onkeyup=cambiarTitulo() required>
                        @error('titulo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4" style="margin-top: 6px">
                        <label for="exampleInputFile">Logo</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" accept="image/*"
                                    name="logo" value="">
                                <label class="custom-file-label" for="exampleInputFile">Seleccione un
                                    logo</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-md-4">
                        <label for="calle" class=" col-form-label text-md-right">Calle</label>
                        <input id="calle" type="text" class="form-control  @error('calle') is-invalid @enderror"
                            name="calle" value="" placeholder="Ingrese la calle" required onkeyup=cambiarCalle()>
                        @error('calle')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label for="altura" class=" col-form-label text-md-right">Altura</label>
                        <input id="altura" type="number" class="form-control  @error('altura') is-invalid @enderror"
                            name="altura" value="" placeholder="Ingrese la altura" required onkeyup=cambiarAltura()>
                        @error('altura')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="ciudad" class=" col-form-label text-md-right">Ciudad</label>
                        <input id="ciudad" type="text" class="form-control  @error('ciudad') is-invalid @enderror"
                            name="ciudad" value="" placeholder="Ingrese la ciudad" required onkeyup=cambiarCiudad()>
                        @error('ciudad')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="form-group row">
                    <div class="form-group col-md-4">
                        <label for="provincia" class=" col-form-label text-md-right">Provincia</label>
                        <input id="provincia" type="text" class="form-control  @error('provincia') is-invalid @enderror"
                            name="provincia" value="" placeholder="Ingrese la provincia" required
                            onkeyup=cambiarProvincia()>
                        @error('provincia')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="pais" class=" col-form-label text-md-right">Pais</label>
                        <input id="pais" type="text" class="form-control  @error('pais') is-invalid @enderror"
                            name="pais" value="" placeholder="Ingrese el pais" required onkeyup=cambiarPais()>
                        @error('pais')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label for="telefono" class=" col-form-label text-md-right">Teléfono</label>
                        <input id="telefono" type="text" class="form-control  @error('telefono') is-invalid @enderror"
                            name="telefono" value="" placeholder="Ingrese el telefono"
                            data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask
                            required onkeyup=cambiarTelefono()>
                        @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="card-footer float">
            <div class="float-right">
                <a href="javascript: history.go(-1)">
                    <button type="button" class="btn btn-default"><i class="fal fa-times"></i>
                        Cancelar</button>
                </a>
                <button type="submit" class="btn btn-primary "><i class="fal fa-check"></i> Guardar</button>
            </div>
        </div>
        </form>
    </div>



    @if (session('success'))
    <script>
        Notiflix.Notify.Success(String(' {{ session('success') }} '));
    </script>
    @endif
    @if (session('error'))
    <script>
        Notiflix.Notify.Failure(String(' {{ session('error') }} '));
    </script>
    @endif

    <script>
        function cambiarTitulo(){

        $('#titulo2').html($('#titulo').val());
        };
        function cambiarCalle(){

        $('#calle2').html('&nbsp;'+$('#calle').val()+'&nbsp;');
        var espacio = " ";
        $('#espacio').html(espacio);
        };
        function cambiarAltura(){

        $('#altura2').html($('#altura').val());
        };
        function cambiarCiudad(){

        $('#ciudad2').html(', '+$('#ciudad').val()+'&nbsp;');
        };
        function cambiarProvincia(){

        $('#provincia2').html($('#provincia').val());
        };
        function cambiarTelefono(){

        $('#telefono2').html('Telefono: '+$('#telefono').val());
        };
        function cambiarPais(){
            $('#pais2').html('&nbsp;'+$('#pais').val());
        };

        document.getElementById('exampleInputFile').onchange = function (evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;

            // FileReader support
            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function () {
                    document.getElementById("logo2").src = fr.result;
                }
                fr.readAsDataURL(files[0]);
            }
        }

    
    </script>
    @isset($gimnasio->reporte_configuracion)
    <script>
        $(document).ready(function(){

            var titulo = "{{$gimnasio->reporte_configuracion->titulo}}";
            $('#titulo2').html(titulo);
            $('#titulo').val(titulo);

            var calle = "{{$gimnasio->reporte_configuracion->calle}}";
            $('#calle2').html('&nbsp;'+calle+'&nbsp;');
            $('#calle').val(calle)

            var altura = "{{$gimnasio->reporte_configuracion->altura}}";
            $('#altura2').html(altura);
            $('#altura').val(altura)

            var ciudad = "{{$gimnasio->reporte_configuracion->ciudad}}";
            $('#ciudad2').html(', '+ciudad+'&nbsp;');
            $('#ciudad').val(ciudad)

            var provincia = "{{$gimnasio->reporte_configuracion->provincia}}";
            $('#provincia2').html(provincia);
            $('#provincia').val(provincia)

            var telefono = "{{$gimnasio->reporte_configuracion->telefono}}";
            $('#telefono2').html('Telefono: '+telefono);
            $('#telefono').val(telefono)

            var pais = "{{$gimnasio->reporte_configuracion->pais}}";
            $('#pais2').html('&nbsp;'+pais);
            $('#pais').val(pais)

            var img = new Image();
            img.src = "{{ asset('/storage/'.$gimnasio->reporte_configuracion->logo) }}";
            $('#logo2').attr("src", img.src);
            // $('#exampleInputFile').val(img.src);


    })
    </script>
    @endisset

    <script type="text/javascript">
        $(document).ready(function () {
      bsCustomFileInput.init();
    });
    </script>

    <script>
        $(document).ready(function(){
      $('#telefono').mask('(0000) 15-000000');
    })
    </script>

    <script>
        $(document).ready(function(){
    const fecha = new moment().format('DD/MM/Y');
    $('#fecha').html('Fecha: '+String(fecha));
    $('#autor').html('<b>Autor: '+"{{$gimnasio->user->name}} {{$gimnasio->user->apellido}}"+'</b>');  
})
    </script>






</body>

@endsection

@endsection
@include('theme.admin-lte.scripts')