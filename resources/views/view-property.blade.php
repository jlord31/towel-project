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
                    <h1>Property Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a> 
                        </li>
                        <li class="breadcrumb-item active">Properties</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

     <!-- user details -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12">

                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">Report List</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                          <table id="property-table" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th> Title </th>
                                    <th>Image</th>
                                    <th> Type </th>
                                    <th>Address</th>
                                    <th>Person Limit </th>
                                    <th>Facilities</th>
                                    <th>Actual Price</th>
                                    <th>Customer Price </th>
                                    <th>Company Profit</th>
                                    <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($properties as $data)
                                    <tr> 
                                        <td>{{ $loop->iteration }}</td>
                                        <td> {{ $data->title }} </td>
                                        <td> {{ $data->image }} </td>
                                        <td> {{ $data->type }} </td>
                                        <td> {{ $data->address }} </td>
                                        <td> {{ $data->people_limit }} </td>
                                        <td> <span class="badge badge-dark tag-pills-sm-mb"> {{ $data->facility }} </span> </td>
                                        <td> {{ $data->actual_price }} </td>
                                        <td> {{ $data->customer_price }} </td>
                                        <td> {{ $data->company_profit }} </td>
                                        <td>
                                            @if($data->status == 'resolved')
                                                    
                                            <button id="resolveBtn-{{ $data->id }}" name="resolveBtn-{{ $data->id }}" data-id="{{$data->id}}" class="btn btn-white"> 
                                                <span class="badge badge-success">{{$data->status}}</span>
                                            </button>
                                                    
                                            @else
                                            <button id="resolveBtn-{{ $data->id }}" name="resolveBtn-{{ $data->id }}" data-id="{{$data->id}}" class="btn btn-white"> 
                                                <span class="badge badge-warning">{{$data->status}}</span>
                                            </button>
                                        
                                            @endif
                                        </td>   
                                    </tr>
                                @endforeach
                              </tbody>
                              <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th> Title </th>
                                    <th>Image</th>
                                    <th> Type </th>
                                    <th>Address</th>
                                    <th>Person Limit </th>
                                    <th>Facilities</th>
                                    <th>Actual Price</th>
                                    <th>Customer Price </th>
                                    <th>Company Profit</th>
                                    <th>Status</th>
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
      <!-- /.end country container-fluid -->
  </section>
  <!-- /.end country details -->
</div>
@endsection

@push('plugin-scripts')
  
@endpush
@push('custom-scripts')
    <!-- DataTables  & Plugins -->
  <script>
    $(document).ready(function () 
    {

      $(function () 
      {
        $("#property-table").DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": true,
          "buttons": ["excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#property-table_wrapper .col-md-6:eq(0)');
      });

    });

  </script>
@endpush