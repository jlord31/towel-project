@extends('layout.master-mini')
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

@section('content')

<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/admin_login_page.jpeg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <div class="auto-form-wrapper">
        <form action="{{route('login')}}" method="POST">
          @csrf
          <div class="form-group">
            <label class="label">Username</label>
            <div class="input-group">
              <input type="text" required class="form-control" name="username" placeholder="Username">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="label">Password</label>
            <div class="input-group">
              <input type="password" required class="form-control" name="password" placeholder="*********">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button class="btn btn-primary submit-btn btn-block">Login</button>
          </div>
          
        </form>
      </div>
      <ul class="auth-footer">
        <li>
          <a href="#">Conditions</a>
        </li>
        <li>
          <a href="#">Help</a>
        </li>
        <li>
          <a href="#">Terms</a>
        </li>
      </ul>
      <p class="footer-text text-center"> copyright &copy; <script> document.write(new Date().getFullYear()); </script> towel. All rights reserved. </p>

    </div>
  </div>
</div>

@endsection