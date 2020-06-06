@extends('theme.admin-lte.template')

@section('title') Registrarse @endsection

@section('body')
@section('sidebarMenu')
@endsection

<body class="container">
    <div class="mt-4 row justify-content-center">
        <div class="col-md-8">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fal fa-user"></i> Registrarse</h3>

                    <div class="card-tools">
                        <div class="float-right">
                            <a role="button" id="popover" data-container="body" title="Ayuda" data-toggle="popover"
                                data-placement="left"
                                data-content="Todos los campos son obligatorios. Si ya posee una cuenta puede iniciar sesión">
                                <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="card-body justify-left-center">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Ingrese su nombre">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="apellido" class="col-md-4 col-form-label text-md-right">Apellido</label>

                            <div class="col-md-6">
                                <input id="apellido" type="text"
                                    class="form-control @error('apellido') is-invalid @enderror" name="apellido"
                                    required placeholder="Ingrese su apellido">

                                @error('apellido')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Ingrese su email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password" placeholder="Ingrese su contraseña">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirme la
                                contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Repita su contraseña">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="fecha_nacimiento" class="col-md-4 col-form-label text-md-right">Fecha de
                                nacimiento</label>

                            <div class="col-md-6">
                                <input id="datemask" type="date"
                                    class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                    im-insert="false" name="fecha_nacimiento">
                            </div>

                            @error('apellido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="altura" class="col-md-4 col-form-label text-md-right">Altura</label>

                            <div class="col-md-6">
                                <input id="altura" type="number"
                                    class="form-control @error('altura') is-invalid @enderror" name="altura" step="0.01"
                                    value="{{ old('altura') }}" placeholder="En m" min="1" pattern="^[0-9]+">

                                @error('altura')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="peso" class="col-md-4 col-form-label text-md-right">Peso</label>

                            <div class="col-md-6">
                                <input id="peso" type="number" class="form-control @error('peso') is-invalid @enderror"
                                    name="peso" value="{{ old('peso') }}" placeholder="Ingrese el peso">

                                @error('peso')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Registrarse <i class="fas fa-arrow-circle-right"></i>
                        </button>
                        <a class="btn btn-link" href="{{ route('login') }}">
                            Ya tienes una cuenta?
                        </a>
                    </div>
                </div>
                <br>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    $(function () {
        $('#popover').popover();
    })
</script>
<script>
    $(function() {
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    });
</script>

@endsection
@include('theme.admin-lte.scripts')