@extends('theme.admin-lte.template')

@section('title') Configurar Email @endsection

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

@section('contentHeader') Configurar los correos automáticos @endsection

<body class="container">
    <div class="">
        <div class="">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title text-center"><i class="fal fa-images"></i> Previsualizacion</h3>
                    <div class="card-tools">
                        <div class="float-right">
                            <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="card-body p-0">
                        <div class="mailbox-read-info">
                            <h5 id="asunto"></h5>
                            <div class="row">
                                <div class="col-10">
                                    <h6 id="">
                                        gymsystemcorreos@gmail.com
                                    </h6>
                                </div>
                                <div class="col-2">
                                    <span class="mailbox-read-time float-right" id="fecha"></span>
                                </div>
                            </div>
                        </div>
                        <!-- /.mailbox-read-info -->

                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            <h5 id="contenido"></h5>

                            <div class="col-6" id="detalle" style="display: none;">
                                <br>
                                <p class="lead">Detalles</p>

                                <div class="table-responsive">
                                    <table class="table" style="width: 350px">
                                        <tbody>
                                            <tr>
                                                <th style="width:70%; text-align: left;" class="text-left">Monto de
                                                    especialidad:</th>
                                                <td id="montoEspecialidad">$$$</td>
                                            </tr>
                                            <tr>
                                                <th style="width:70%; text-align: left;" class="text-left">Monto de
                                                    deuda</th>
                                                <td id="montoDeuda">$$$</td>
                                            </tr>
                                            <tr>
                                                <th style="width:70%; text-align: left;" class="text-left">Monto total:
                                                </th>
                                                <td id="montoTotal">$$$</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <br>
                            <p style="color:rgb(130, 128, 128)">Si necesita mayor informacion puede enviar un email a la
                                siguiente direccion
                                <p id="remitente" style="color:#15c; cursor: pointer;
                                    text-decoration: underline;"></p>
                            </p>


                        </div>
                        <!-- /.mailbox-read-message -->
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-teal card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fal fa-edit"></i> Modificar el correo</strong></h3>

                <div class="card-tools">
                    <div class="float-right">
                        <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                    </div>
                </div>
            </div>


            <div class="card-body">

                <form method="POST" action="/email_configuracion/{{ $gimnasio->id }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="asunto" class="col-md-1 col-form-label">Asunto</label>
                        <div class="col-md-5">
                            <input type="text" name="asunto" class="form-control @error('asunto') is-invalid @enderror"
                                id="asuntoInput" placeholder="Ingrese el asunto" onkeyup=cambiarAsunto()
                                value="@isset($gimnasio->email_configuracion){{ $gimnasio->email_configuracion->asunto }}@endisset"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="remitente" class="col-md-1 col-form-label">Remitente</label>
                        <div class="col-md-3">
                            <input type="email" maxlength="128" name="remitente"
                                class="form-control @error('remitente') is-invalid @enderror" id="remitenteInput"
                                placeholder="Ingrese el email" onkeyup=cambiarRemitente() value="@if (isset($gimnasio->email_configuracion))
                                                                        {{ $gimnasio->email_configuracion->remitente }} 
                                                                    @else 
                                                                        {{ $gimnasio->email }} 
                                                                    @endif" required>
                            <small class="form-text text-muted">Por defecto es el correo asociado al gimnasio</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contenido" class="col-md-1 col-form-label">Contenido</label>
                        <div class="col-md-6">
                            <textarea rows="5" name="contenido"
                                class="form-control @error('contenido') is-invalid @enderror" id="contenidoInput"
                                placeholder="Ingrese el contenido del email" onkeyup=cambiarContenido()
                                required>@isset($gimnasio->email_configuracion){{ $gimnasio->email_configuracion->contenido }}@endisset</textarea>


                        </div>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="detalle_monto" class="custom-control-input" id="customSwitch1"
                            value="1" onchange="mostrar_ocultar()" id="toggleDetalleMonto">
                        <label class="custom-control-label" for="customSwitch1">Añadir detalle de montos al
                            correo</label>
                    </div>

            </div>
            <div class="card-footer float">
                <div class="float-right">
                    <a href="javascript: history.go(-1)">
                        <button type="button" class="btn btn-default"><i class="fal fa-times"></i> Cancelar</button>
                    </a>
                    <button type="submit" class="btn btn-primary "><i class="fal fa-check"></i> Guardar</button>
                </div>
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
        function cambiarAsunto(){

        $('#asunto').html($('#asuntoInput').val());
    };
    function cambiarRemitente(){

        $('#remitente').html($('#remitenteInput').val());
    };
    function cambiarContenido(){

        $('#contenido').html($('#contenidoInput').val());
    };
    </script>

    <script>
        $(document).ready(function(){
        $('#asunto').html($('#asuntoInput').val());
        $('#remitente').html($('#remitenteInput').val());
        $('#contenido').html($('#contenidoInput').val());
    })
    </script>
    @isset($gimnasio->email_configuracion)
    <script>
        $(document).ready(function(){
        const detalle_monto = " {{ $gimnasio->email_configuracion->detalle_monto }} ";
        console.log(detalle_monto);
        if (detalle_monto == 1){
            $("#detalle").css("display", "block");
            customSwitch1.checked = true;
        }else{
            $("#detalle").css("display", "none");
            customSwitch1.checked = false;
        }
    })
    </script>
    @endisset
    <script>
        $(document).ready(function(){
        const fecha = new moment().format('DD/MM/Y');
        const hora = new moment().format('HH:mm');
        const html = fecha +' a las '+ hora+'hs';
        $('#fecha').html(String(html));
    })
    </script>




</body>

@endsection

@endsection
@include('theme.admin-lte.scripts')