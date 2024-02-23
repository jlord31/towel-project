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
  {!! Html::style('/assets/plugins/jquery-ui/jquery-ui.min.css') !!}
  {!! Html::style('/assets/plugins/daterangepicker/daterangepicker.css') !!}

  <!-- Select2 -->
  {!! Html::style('assets/plugins/select2/css/select2.min.css') !!}
  {!! Html::style('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}

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

  {!! Html::script('assets/plugins/select2/js/select2.full.min.js') !!}
  {!! Html::script('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') !!}
  {!! Html::script('assets/plugins/moment/moment.min.js') !!}
  {!! Html::script('assets/plugins/inputmask/jquery.inputmask.min.js') !!}
  {!! Html::script('assets/plugins/daterangepicker/daterangepicker.js') !!}

  <!-- end common js -->

  <!-- plugin js -->
  @stack('plugin-scripts')
  <!-- end plugin js -->

  
  {!! Html::script('assets/dist/js/adminlte.min.js') !!}
  {!! Html::script('assets/plugins/toastr/toastr.min.js') !!}

  @stack('custom-scripts')

  <!-- show toast message -->
  @if(Session::has('success'))
    <script>
      toastr.success("{{ Session::get('success') }}");
    </script>
  @endif

  @if(Session::has('warning'))
    <script>
      toastr.warning("{{ Session::get('warning') }}");
    </script>
  @endif

  @if(Session::has('error'))
    <script>
      toastr.error("{{ Session::get('error') }}");
    </script>
  @endif

</body>
</html>