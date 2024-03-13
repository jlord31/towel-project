@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush


@section('content')

@endsection

@push('plugin-scripts')
  
@endpush
@push('custom-scripts')
    
@endpush

<td>
                                            <img class="img img-fluid rounded" src="{{ asset('assets/uploads/user/profile/'.$data->pro_pic) }}"
                                            alt="User profile" width="50" height="50" />
                                        </td>

<!-- property details -->
<section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Property List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="property-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th> Title </th>
                                        <th>Image</th>
                                        <th> Country</th>
                                        <th> Type </th>
                                        <th>Address</th>
                                        <th>Bedroom</th>
                                        <th>Bathroom</th>
                                        <th>Person Limit </th>
                                        <th>Facilities</th>
                                        <th>Rating</th>
                                        <th>Actual Price</th>
                                        <th>Customer Price </th>
                                        <th>Company Profit</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($property as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td> {{ $data->title }} </td>
                                        <td> {{ $data->image }} </td>
                                        <td> {{ $data->country_id }} </td>
                                        <td> {{ $data->type }} </td>
                                        <td> {{ $data->address }} </td>
                                        <td> {{ $data->beds }} </td>
                                        <td> {{ $data->bathroom }} </td>
                                        <td> {{ $data->people_limit }} </td>
                                        <td> {{ $data->facility }} </td>
                                        <td> {{ $data->rate }} </td>
                                        <td> {{ $data->actual_price }} </td>
                                        <td> {{ $data->customer_price }} </td>
                                        <td> {{ $data->company_profit }} </td>
                                        <td> {{ $data->description }} </td>
                                        
                                        
                                        @if($data->status == 'active')
                                                
                                        <button id="showOnMobileBtn" name="showOnMobileBtn" data-id="{{$data->id}}" class="btn btn-white"> 
                                            <span class="badge badge-success">{{$data->status}}</span>
                                        </button>
                                                
                                        @else
                                        <button id="showOnMobileBtn" name="showOnMobileBtn" data-id="{{$data->id}}" class="btn btn-white"> 
                                            <span class="badge badge-warning">{{$data->status}}</span>
                                        </button>
                                    
                                        @endif
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th> Title </th>
                                        <th>Image</th>
                                        <th> Country</th>
                                        <th> Type </th>
                                        <th>Address</th>
                                        <th>Bedroom</th>
                                        <th>Bathroom</th>
                                        <th>Person Limit </th>
                                        <th>Facilities</th>
                                        <th>Rating</th>
                                        <th>Actual Price</th>
                                        <th>Customer Price </th>
                                        <th>Company Profit</th>
                                        <th>Description</th>
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
    <!-- /.end property details -->
