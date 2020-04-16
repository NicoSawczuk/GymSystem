@extends('theme.admin-lte.template')

@section('title') Perfil pendiente de moderación @endsection

@section('body')
<body class="container-fluid">
    <div class=" mt-4 row justify-content-center">
        <div class="col-md-9">
            <div class="alert bg-teal alert-dismissible">
                <h3><i class="fas fa-check-circle"></i> Registro completo</h3>
                
                <p>Hola {{Auth::user()->name}} {{Auth::user()->apellido}}, Bienvenido a GymSystem
                <br>Tu perfil está pendiente de revisión, en breve lo estaremos haciendo y ya podrás utilizar nuestros servicios.</p>
            </div>
        </div>
    </div>
</body>


@endsection
@include('theme.admin-lte.scripts')