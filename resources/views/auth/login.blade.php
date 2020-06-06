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
    <title>Iniciar sesión</title>
</head>

<body>
    <div class="mt-2 container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-teal card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fal fa-user"></i> Iniciar sesión</h3>

                        <div class="card-tools">
                            <div class="float-right">
                                <a role="button" id="popover" data-container="body" title="Ayuda" data-toggle="popover"
                                    data-placement="left"
                                    data-content="Debes ingresar tu información de usuario para ingresar al sistema. Si no posees una cuenta puedes registrarte">
                                    <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Recordar sesión') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Ingresar') }}
                                        <i class="fas fa-arrow-circle-right"></i>
                                    </button>

                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Perdiste tu contraseña?') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Scripts --}}

    <!-- jQuery -->
    <script src="{{ asset("assets/admin-lte/plugins/jquery/jquery.min.js") }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset("assets/admin-lte/plugins/jquery-ui/jquery-ui.min.js") }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset("assets/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset("assets/admin-lte/plugins/chart.js/Chart.min.js") }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset("assets/admin-lte/plugins/sparklines/sparkline.js") }}"></script>
    {{-- <!-- JQVMap -->
<script src="{{ asset("assets/admin-lte/plugins/jqvmap/jquery.vmap.min.js") }}"></script>
    <script src="{{ asset("assets/admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js") }}"></script> --}}
    <!-- jQuery Knob Chart -->
    <script src="{{ asset("assets/admin-lte/plugins/jquery-knob/jquery.knob.min.js") }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset("assets/admin-lte/plugins/moment/moment.min.js") }}"></script>
    <script src="{{ asset("assets/admin-lte/plugins/daterangepicker/daterangepicker.js") }}"></script>
    {{-- <!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset("assets/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") }}">
    </script> --}}
    <!-- Summernote -->
    <script src="{{ asset("assets/admin-lte/plugins/summernote/summernote-bs4.min.js") }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset("assets/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset("assets/admin-lte/dist/js/adminlte.js") }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset("assets/admin-lte/dist/js/pages/dashboard.js") }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset("assets/admin-lte/dist/js/demo.js") }}"></script>
    <!-- DataTables -->
    <script src="{{ asset("assets/admin-lte/plugins/datatables/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("assets/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
    <script src="{{ asset("assets/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}">
    </script>
    <script src="{{ asset("assets/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}">
    </script>
    {{-- <!-- Selectpicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.min.js"></script> --}}

    <!-- InputMask -->
    <script src="{{ asset("assets/admin-lte/plugins/moment/moment.min.js") }}"></script>
    <script src="{{ asset("assets/admin-lte/plugins/inputmask/min/jquery.inputmask.bundle.min.js") }}"></script>

    <!-- PhoneMask -->
    <script src="{{ asset("assets/mask/jquery.mask.js") }}"></script>

    <!-- Select2 -->
    <script src="{{ asset("assets/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("assets/admin-lte/plugins/select2/js/select2.full.min.js") }}"></script>

    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset("assets/admin-lte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js") }}">
    </script>



    <!-- Notiflix -->
    <script src="{{ asset("assets/notiflix/Minified/notiflix-2.1.2.min.js") }}"></script>
    <script>
        Notiflix.Notify.Init({ 
     closeButton:true,
     distance:"15px",
     fontSize:"14px",
     useFontAwesome:true,
     fontAwesomeIconStyle:"fal",
     cssAnimation:true,
     cssAnimationStyle:"from-top",
     timeout:300,
     messageMaxLength:1000,
     width:'300px',
     success: {background:"rgba(50,198,130,0.959)", }, 
     failure: {background:"rgba(255,85,73,0.947)",}, 
     warning: {background:"rgba(238,191,49,0.953)",}, 
     info: {background:"rgba(38,192,211,0.947)",}, }); 
    </script>
    <script>
        Notiflix.Confirm.Init({ 
     width:"400px",
     position:"center-top",
     titleFontSize:"20px",
     distance:"20px",
     messageFontSize:"16px",
     useGoogleFont:false,
     cancelButtonBackground:"#c7c7c7",
     titleColor:"#e70505",
     okButtonBackground:"#ec4d4d", }); 
    </script>


    <!-- bs-custom-file-input -->
    <script src="{{ asset("assets/admin-lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js") }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
    bsCustomFileInput.init();
  });
    </script>

    <!-- Sweetalert2 -->
    <script src="{{ asset("assets/sweetalert2/sweetalert2@9.js") }}"></script>

    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset("assets/admin-lte/plugins/moment/moment.min.js") }}"></script>
    <script src="{{ asset("assets/admin-lte/plugins/moment/locale/es.js") }}"></script>
    <script src="{{ asset("assets/admin-lte/plugins/fullcalendar/main.min.js") }}"></script>
    <script src="{{ asset("assets/admin-lte/plugins/fullcalendar-daygrid/main.min.js") }}"></script>
    <script src="{{ asset("assets/admin-lte/plugins/fullcalendar-timegrid/main.min.js") }}"></script>
    <script src="{{ asset("assets/admin-lte/plugins/fullcalendar-interaction/main.min.js") }}"></script>
    <script src="{{ asset("assets/admin-lte/plugins/fullcalendar-bootstrap/main.min.js") }}"></script>
    <script src="{{ asset("assets/admin-lte/plugins/fullcalendar-list/main.min.js") }}"></script>


    {{-- Datatable Export --}}
    <script src="{{ asset("assets/export-datatable/dataTables.buttons.min.js") }}"></script>
    <script src="{{ asset("assets/export-datatable/buttons.bootstrap4.min.js") }}"></script>
    <script src="{{ asset("assets/export-datatable/jszip.min.js") }}"></script>
    <script src="{{ asset("assets/export-datatable/pdfmake.min.js") }}"></script>
    <script src="{{ asset("assets/export-datatable/vfs_fonts.js") }}"></script>
    <script src="{{ asset("assets/export-datatable/buttons.html5.min.js") }}"></script>
    <script src="{{ asset("assets/export-datatable/buttons.print.min.js") }}"></script>
    <script src="{{ asset("assets/export-datatable/buttons.colVis.min.js") }}"></script>


    <!-- bs-custom-file-input -->
    <script src="{{ asset("assets/admin-lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js") }}"></script>

    <script>
        $(function () {
            $('#popover').popover();
        })
    </script>
</body>