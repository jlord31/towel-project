<!DOCTYPE html>
<html>
<head>
  <title>Towel Admin Dashboard</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- plugin css -->
  {!! Html::style('assets/plugins/fontawesome-free/css/all.min.css') !!}
  {!! Html::style('assets/dist/css/adminlte.min.css') !!}
  {!! Html::style('assets/plugins/toastr/toastr.min.css') !!}
  <!-- end plugin css -->


  @stack('plugin-styles')


  @stack('style')
</head>
<body class="hold-transition sidebar-mini">

  <div class="wrapper">

    @include('layout.header')
    
    @include('layout.sidebar')
      
    @yield('content')
        
    @include('layout.footer')
      
  </div>

  <!-- common js -->
  {!! Html::script('assets/plugins/jquery/jquery.min.js') !!}
  {!! Html::script('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}
  <!-- end common js -->

  <!-- plugin js -->
  @stack('plugin-scripts')
  <!-- end plugin js -->

  <!-- show toast message -->
  @if(Session::has('success'))
    <script>
      toastr.success("{{ Session::get('success') }}");
    </script>
  @endif

  @if(Session::has('error'))
    <script>
      toastr.error("{{ Session::get('error') }}");
    </script>
  @endif

  
  {!! Html::script('assets/dist/js/adminlte.min.js') !!}
  {!! Html::script('assets/plugins/toastr/toastr.min.js') !!}

  @stack('custom-scripts')
</body>
</html>