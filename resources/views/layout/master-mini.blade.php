<!DOCTYPE html>
<html>

<head>
    <title>Towel Admin Panel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}">

    <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- plugin css -->

    <!-- Font Awesome -->
    {!! Html::style('assets/plugins/fontawesome-free/css/all.min.css') !!}
    <!-- icheck bootstrap -->
    {!! Html::style('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}
    <!-- App style -->
    {!! Html::style('assets/dist/css/adminlte.min.css') !!}
    <!-- Toastr style -->
    {!! Html::style('assets/plugins/toastr/toastr.min.css') !!}
    <!-- end plugin css -->

</head>

<body class="hold-transition login-page" style="background-image: url({{ url('assets/images/admin_login_page.jpeg') }}); background-size: cover;">

    @yield('content')


    <!-- plugin js -->

    <!-- jQuery -->
    {!! Html::script('assets/plugins/jquery/jquery.min.js') !!}
    <!-- Bootstrap 4 -->
    {!! Html::script('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}
    <!-- toastr -->
    {!! Html::script('assets/plugins/toastr/toastr.min.js') !!}
    <!-- AdminLTE App -->
    {!! Html::script('assets/dist/js/adminlte.min.js') !!}
    

    <!-- end plugin js -->

    <!-- show toast message -->
    @if(session()->has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}");
        </script>
      @endif

      @if(session()->has('error'))
        <script>
            toastr.error("{{ Session::get('error') }}");
        </script>
      @endif

</body>

</html>
