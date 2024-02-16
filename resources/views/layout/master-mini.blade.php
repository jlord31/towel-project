<!DOCTYPE html>
<html>
<head>
  <title>Towel Admin Dashboard</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  <!-- plugin css -->
  {!! Html::style('assets/plugins/@mdi/font/css/materialdesignicons.min.css') !!}
  {!! Html::style('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') !!}
  {!! Html::style('assets/plugins/toastr/toastr.min.css') !!}
  <!-- end plugin css -->

  <!-- plugin css -->
  @stack('plugin-styles')
  <!-- end plugin css -->

  @push('plugin-styles')
    <style>
        
        /* Override toastr styles */
        .toast-success {
            background-color: #28a745; /* Set the background color for success messages */
            color: #fff; /* Set the text color for success messages */
        }
        .toast-warning {
        color: #fff;
        background-color: #f0ad4e;
        }
        .toast-error {
            background-color: #dc3545; /* Set the background color for error messages */
            color: #fff; /* Set the text color for error messages */
        }

    </style>
  @endpush

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

  <!-- common css -->
    {!! Html::style('css/app.css') !!}
  <!-- end common css -->

  @stack('style')
</head>
<body data-base-url="{{url('/')}}">

  <div class="container-scroller" id="app">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      @yield('content')
    </div>
  </div>

    <!-- base js -->
    {!! Html::script('js/app.js') !!}
    {!! Html::script('assets/plugins/toastr/toastr.min.js') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    @stack('custom-scripts')
</body>
</html>