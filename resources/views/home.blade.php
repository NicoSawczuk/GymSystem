@extends('theme.admin-lte.template')

@section('title') Home @endsection

@section('body')
    @parent

    @section('nombreGimnasio') <strong>{{ $gimnasio->nombre }}</strong> @endsection

    @section('usuario')
        {{ Auth::user()->name }} {{ Auth::user()->apellido }}
    @endsection


    @section('contentHeader')
        Pagina principal
    @endsection



    @section('content')
    
        
    @endsection

@endsection

