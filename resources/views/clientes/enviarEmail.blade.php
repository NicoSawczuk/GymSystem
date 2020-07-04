@extends('theme.admin-lte.template')

@section('title') Enviar E-mail @endsection

@section('body')
@parent


@section('content')

@section('contentHeader') Enviar E-mail a {{ $cliente->nombre }} {{ $cliente->apellido }} @endsection

<body class="container">
  <form action="{{route('clientes.sendEmail',[$cliente->id,$cliente->slug()])}}" method="POST">
    @csrf
    @method('POST')
    <div class="card card-teal card-outline">
      <div class="card-header">
        <h3 class="card-title"><i class="fal fa-edit"></i> Escribir E-mail</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="form-group">
          <label for="destinatario" class="col-form-label text-md-right">Destinatario</label>
          <input type="text" class="form-control @error('destinatario') is-invalid @enderror" name="destinatario"
            value="{{ $cliente->email }}" placeholder="Ingrese un destinatario" disabled>
          @error('destinatario')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="asunto" class="col-form-label text-md-right">Asunto</label>
          <input type="text" class="form-control @error('asunto') is-invalid @enderror" name="asunto"
            value="{{ old('asunto') }}" placeholder="Ingrese un asunto" required>
          @error('asunto')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="contenido" class="col-form-label text-md-right">Contenido</label>
          <textarea id="compose-textarea" name="contenido" class="form-control @error('contenido') is-invalid @enderror"
            required></textarea>
          @error('contenido')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <div class="float-right">
          <a href="{{route('clientes.perfil',[$cliente->id, $cliente->slug()])}}">
            <button type="button" class="btn btn-default"><i class="fal fa-times"></i> Cancelar</button>
          </a>
          <button type="submit" class="btn btn-primary"><i class="fal fa-envelope"></i> Enviar</button>
        </div>
      </div>
      <!-- /.card-footer -->
    </div>
  </form>
  <!-- /.card -->

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
    $(function () {
      //Add text editor
      $('#compose-textarea').summernote();
    })
  </script>

  <script>
    $( document ).ready(function() {
        $('div.note-group-select-from-files').remove();
});
  </script>

</body>

@endsection

@endsection
@include('theme.admin-lte.scripts')