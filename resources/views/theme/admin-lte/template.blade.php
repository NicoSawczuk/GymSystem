<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@section('title')@show</title>
        @include('theme.admin-lte.head')
      </head>

<body class="hold-transition sidebar-mini layout-fixed">
  
@section('body')

<div class="wrapper">

@include('theme.admin-lte.navbar')

@include('theme.admin-lte.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  
    {{-- Content --}}
    @include('theme.admin-lte.contentWrapper')

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

        @section('content')
            
        @show

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

@section('scripts')
@stack('theme.admin-lte.scripts');
@show
@show
</body>
</html>
