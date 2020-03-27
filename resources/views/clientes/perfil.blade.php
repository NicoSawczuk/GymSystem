@extends('theme.admin-lte.template')

@section('title') Perfil de usuario @endsection

@section('body')
@parent


@section('content')


    
@section('contentHeader') Perfil de {{ $cliente->nombre }} {{ $cliente->apellido }}@endsection
<body class="container-fluid">
    <div class="">
        <div class="">

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


@endsection
@include('theme.admin-lte.scripts')