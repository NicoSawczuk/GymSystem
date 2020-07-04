@extends('theme.admin-lte.template')

@section('title') Editar {{ $usuario->name }} {{ $usuario->apellido }} @endsection

@section('body')
@parent


@section('content')

@section('contentHeader') Editar roles y permisos @endsection

<body class="container">
    <div class="">
        <div class="">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fal fa-edit"></i> Roles y permisos de <strong>{{ $usuario->name }}
                            {{ $usuario->apellido }}</strong></h3>

                    <div class="card-tools">
                        <div class="float-right">
                            <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <form method="POST" action="{{ route('usuarios.update',[$usuario->id, $usuario->slug()]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <div class="form-group">
                                <label for="permisos" class=" col-form-label text-md-right">Permisos</label>

                                <select class="duallistbox" multiple="multiple" style="min-height: 250px"
                                    name="permisos[]">
                                    @foreach ($permisos as $permiso)
                                    @if ($usuario->permissions->contains('id',$permiso->id))
                                    <option value="{{$permiso->id}}" selected>{{ $permiso->name }}</option>
                                    @else
                                    <option value="{{$permiso->id}}">{{ $permiso->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-group">
                                <label for="roles" class=" col-form-label text-md-right">Roles</label>

                                <select class="duallistbox" multiple="multiple" name="roles[]">
                                    @foreach ($roles as $rol)
                                    @if ($usuario->roles->contains('id',$rol->id))
                                    <option value="{{$rol->id}}" selected>{{ $rol->name }}</option>
                                    @else
                                    <option value="{{$rol->id}}">{{ $rol->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="card-footer float">
                    <div class="float-right">
                        <a href="{{ route('usuarios.administrar') }}">
                            <button type="button" class="btn btn-default"><i class="fal fa-times"></i> Cancelar</button>
                        </a>
                        <button type="submit" class="btn btn-primary "><i class="fal fa-check"></i> Guardar</button>
                    </div>
                </div>
            </div>
            </form>
        </div>

        <script>
            $(function(){
            $('.duallistbox').bootstrapDualListbox()
        })
        </script>


</body>

@endsection

@endsection
@include('theme.admin-lte.scripts')