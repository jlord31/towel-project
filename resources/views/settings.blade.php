@extends('layout.master')

@push('plugin-styles')
    <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body row">
                <div class="col-3 text-center d-flex align-items-center justify-content-center">
                    <div class="">
                        <p> 
                            <img src="{{ url('images/logo.jpg') }}" style="height:50px; width:50px;" alt="logo" /> 
                        </p>
                        <h2>Towel<strong>Admin</strong></h2>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#profile" data-toggle="tab">Profile Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#password" data-toggle="tab">Change Password</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="profile">
                                    <form class="form-horizontal" action="{{route('settings')}}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-2 col-form-label">username</label>
                                            <div class="col-sm-10">
                                                @auth
                                                <input type="text" class="form-control" maxlength="40" required
                                                    name="username" id="username" value="{{ Auth::user('admin_user')->username }}"
                                                    placeholder="Enter username here">
                                                @endauth
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="profile_image" class="col-sm-2 col-form-label">Profile image</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="custom-file-input" name="image" id="image"
                                                placeholder="leave blank if you do not wish to change profile image"/>
                                                <label class="custom-file-label" for="exampleInputFile" style="color:red;">Choose file; leave blank if you do not wish to change profile image</label>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="password">
                                    <form class="form-horizontal" action="{{route('change-password')}}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="new_password" class="col-sm-2 col-form-label">Enter new
                                                password</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" maxlength="40" required
                                                    name="password" id="password"
                                                    placeholder="Enter password here">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm
                                                new password</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" maxlength="40" required
                                                    name="password_confirmation" id="password_confirmation"
                                                    placeholder="Confirm password here">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->
@endsection

@push('plugin-scripts')

@endpush
@push('custom-scripts')

@endpush
