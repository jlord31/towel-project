@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ride Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Rides</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- add category section -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Ride</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('add-ride')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                        <div class="form-group">
                            <label for="inputRideType">Ride type</label>
                            <select id="ride_tpe" name="ride_tpe" class="form-control custom-select">
                                <option selected disabled>Select one</option>
                                <option>Suv</option>
                                <option>Trucks</option>
                                <option>Supercars</option>
                                <option>Bikes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Car Model</label>
                            <input type="text" id="model" name="model" class="form-control" required placeholder="Enter car model here"/>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Car Color</label>
                            <input type="text" id="color" name="color" class="form-control" required placeholder="Enter car color here"/>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Price per day - customer</label>
                            <input type="number" id="customer_price_per_day" name="customer_price_per_day" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="inputName">Price per day - actual/company price</label>
                            <input type="number" id="actual_price_per_day" name="actual_price_per_day" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label for="inputName">Airport Pickup Price - customer</label>
                            <input type="number" id="airport_park_pickup_customer_price" name="airport_park_pickup_customer_price" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="inputName">Airport Pickup Price - actual/company price</label>
                            <input type="number" id="airport_park_pickup_actual_price" name="airport_park_pickup_actual_price" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Car image</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" required name="image" id="image"/>
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Status</label>
                            <select id="status" name="status" class="form-control custom-select">
                                <option selected disabled>Select one</option>
                                <option>active</option>
                                <option>inactive</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <input type="reset" value="Cancel" class="btn btn-secondary" />
                <input type="submit" value="Add" class="btn btn-success float-right"/>
            </div>
        </div>
        </form>
    </section>
    <!-- /.end add category section -->


    <!-- category details -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Rides List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="facility-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rides as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td> {{$data->title}} </td>
                                        <td><img src="{{ asset('assets/uploads/facility/'.$data->img) }}"  alt="facility image" width="50" height="50"/></td>
                                        <td> 
                                            @if($data->status == 'active')
                                            <span class="badge badge-success">{{$data->status}}</span>
                                            @else
                                            <span class="badge badge-warning">{{$data->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap">
                                                <button type="submit" class="btn btn-small btn-secondary mr-1" data-toggle="modal" data-target="#edit-modal" data-id="{{ $data->id }}"><i class="fas fa-edit"></i></button>
                                                
                                                <button type="submit" class="btn btn-danger deleteBtn" data-toggle="modal" data-target="#DeleteModal" data-id="{{ $data->id }}"><i class="fas fa-trash"></i></button>
                                        
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.end category container-fluid -->
    </section>
    <!-- /.end category details -->

</div>
<!-- /.content-wrapper -->
@endsection

@push('plugin-scripts')
  
@endpush
@push('custom-scripts')
    
@endpush