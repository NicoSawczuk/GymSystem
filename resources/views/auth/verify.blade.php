<head>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("assets/admin-lte/plugins/fontawesome-free/css/all.min.css") }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset("assets/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset("assets/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">
    {{-- <!-- JQVMap -->
<link rel="stylesheet" href="{{ asset("assets/admin-lte/plugins/jqvmap/jqvmap.min.css") }}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("assets/admin-lte/dist/css/adminlte.min.css") }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset("assets/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset("assets/admin-lte/plugins/daterangepicker/daterangepicker.css") }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset("assets/admin-lte/plugins/summernote/summernote-bs4.css") }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Notiflix -->
    <link rel="stylesheet" href="{{ asset("assets/notiflix/Minified/notiflix-2.1.2.min.css") }}">
    {{-- <!-- Selectpicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/css/bootstrap-select.min.css" /> --}}
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset("assets/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
    <link rel="stylesheet"
        href="{{ asset("assets/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset("assets/admin-lte/plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet"
        href="{{ asset("assets/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}">
    {{-- Icon --}}
    <link rel="icon" href="{{ asset("assets/icon/GymSystem.png") }}">
    <title>Verificacion de correo electrónico</title>
</head>

<body>
    <div class="mt-2 container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-teal card-outline">
                    <div class="card-header">Verifica tu correo electrónico</div>

                    <div class="card-body">
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Un mail de verificación ha sido enviado a tu dirección de correo electrónico
                        </div>
                        @endif

                        Por favor revisa tu casilla correo electrónico
                        Si no recibiste ningún mail,
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">Solicita un reenvío</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>