@extends('theme.admin-lte.template')

@section('title') Administrar gimnasios @endsection

@section('body')
<body class="container">
    <div class=" mt-4 row justify-content-center">
        <div class="col-md-8">


            <div class="card card-teal card-outline">
                <div class="card-header">
                  <h3 class="card-title">Mis gimnasios</h3>
      
                  <div class="card-tools">
                    <div class="float-right">
                        <a title="Agregar un gimnasio" class="fal fa-plus-circle fa-lg" href="/gimnasios/create/{{ Auth::user()->id }}"></a>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                
                <div class="card-body table-responsive p-0 table-hover text-nowrap">
                @isset($gimnasios)
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Especialidad</th>
                        <th>Dirección</th>
                        <th>Inscriptos</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($gimnasios as $gimnasio)
                      <tr>
                        <td>{{ $gimnasio->nombre }}</td>
                        <td>{{ $gimnasio->especialidad }}</td>
                        <td>{{ $gimnasio->calle }} {{ $gimnasio->altura }}</td>
                        <td></td>
                        <td >
                            <a title="Editar gimnasio" href="/gimnasios/{{ $gimnasio->id }}/edit"><i class="fal fa-pencil-alt"></i></a>
                            <a title="Eliminar gimnasio" href=""><i  class="fal fa-trash-alt"></i></a>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                @endisset
                @empty($gimnasios)
                <p>Aun no tienes gimnasios, por favor crea uno</p>
                @endempty
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
        </div>
    </div>





    <script>
        $(document).ready(function() {
            
    });
    </script>




@if (session('status'))
<script>
    Notiflix.Notify.Success(String(' {{ session('status') }} '));
</script>
@endif



</body>


@endsection
@include('theme.admin-lte.scripts')