@extends('theme.admin-lte.template')

@section('title') Panel de administrador @endsection

@section('body')

<body class="container-fluid">
    <div class="mt-4 row justify-content-center">
        <div class="col-md-8">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fal fa-hammer"></i>
                        Panel
                    </h3>

                    <div class="card-tools">
                        <div class="float-right">
                            <a role="button" id="popover" data-container="body" title="Ayuda" data-toggle="popover"
                                data-placement="left" data-content="descripcion de ayuda">
                                <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body pb-0">

                    <div class="row d-flex align-items-stretch">
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                            <div class="card bg-light" style="min-width: 270px; max-width: 290px;">
                                <div class="card-header text-muted border-bottom-0">
                                    Usuarios, roles y permisos
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row" style="min-width: 270px; max-width: 290px;">
                                        <div class="col-sm-6">
                                            <p class="text-muted text-sm">
                                                Ver el listado de usuarios y poder administrar sus roles y permisos
                                            </p>
                                        </div>
                                        <div class="col-sm-5 text-center">
                                            <i class="fal fa-users-cog fa-6x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{ route('usuarios.administrar') }}" class="btn btn-sm btn-primary">
                                            Administrar <i class="fas fa-arrow-circle-right fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                            <div class="card bg-light" style="min-width: 270px; max-width: 290px;">
                                <div class="card-header text-muted border-bottom-0">
                                    Cuotas mensuales
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row" style="min-width: 270px; max-width: 290px;">
                                        <div class="col-sm-6">
                                            <p class="text-muted text-sm">
                                                Ver el listado de cuotas pagadas junto a sus detalles
                                            </p>
                                        </div>
                                        <div class="col-sm-5 text-center">
                                            <i class="fal fa-cash-register fa-6x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="#" class="btn btn-sm btn-primary">
                                            Administrar <i class="fas fa-arrow-circle-right fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                            <div class="card bg-light" style="min-width: 270px; max-width: 290px;">
                                <div class="card-header text-muted border-bottom-0">
                                    Montos mensuales
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row" style="min-width: 270px; max-width: 290px;">
                                        <div class="col-sm-6">
                                            <p class="text-muted text-sm">
                                                Actualiza y carga los montos para las cuotas mensuales del sistema
                                            </p>
                                        </div>
                                        <div class="col-sm-5 text-center">
                                            <i class="fal fa-money-check-alt fa-6x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{route('montosMensuales.administrar')}}" class="btn btn-sm btn-primary">
                                            Administrar <i class="fas fa-arrow-circle-right fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-stretch">
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                            <div class="card bg-light" style="min-width: 270px; max-width: 290px;">
                                <div class="card-header text-muted border-bottom-0">
                                    Códigos de descuento
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row" style="min-width: 270px; max-width: 290px;">
                                        <div class="col-sm-6">
                                            <p class="text-muted text-sm">
                                                Agrega códigos de descuento para el pago de cuotas
                                            </p>
                                        </div>
                                        <div class="col-sm-5 text-center">
                                            <i class="fal fa-percent fa-6x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{route('descuentos.administrar')}}" class="btn btn-sm btn-primary">
                                            Administrar <i class="fas fa-arrow-circle-right fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
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



</body>


@endsection
@include('theme.admin-lte.scripts')