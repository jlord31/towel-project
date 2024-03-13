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
                    <h1>Property Unavaliable Date</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a> 
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('view-property') }}">Property List</a> 
                        </li>
                        <li class="breadcrumb-item active"> Set Property Unavaliable Date </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

     <!-- unavliable date section -->
     <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Unavaliable Dates</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('save-unavaliable-dates')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                        <div class="form-group">
                            <label for="inputProperty">Property List</label>
                            <select id="property_id" name="property_id" class="form-control custom-select">
                                <option selected disabled>Select one property</option>
                                @foreach ($property as $prop)
                                    <option value="{{$prop->id}}">{{$prop->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date and time range -->
                        <div class="form-group">
                        <label>Select Property Unavaliable Date and time range:</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" name="reservationtime" id="reservationtime">
                        </div>
                        <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

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
    <!-- /.end unavliable date section -->

    <!-- country details -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Property Unavaliable Date List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="dates-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Property Name</th>
                                        <th>Unavaliable From</th>
                                        <th>Unavaliable To</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($unavaliable as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td> {{$data->property->title}} </td>
                                       
                                        <td> 
                                            {{ $data->from }} 
                                        </td>
                                        <td> {{$data->to}} </td>
                                       
                                        <td>
                                            @if($data->status == 'active')
                                                    
                                            <button id="showOnMobileBtn" name="showOnMobileBtn" data-id="{{$data->property_id}}" class="btn show"> 
                                                <span class="badge badge-success">{{$data->status}}</span>
                                            </button>
                                                    
                                            @else
                                            <button id="showOnMobileBtn" name="showOnMobileBtn" data-id="{{$data->property_id}}" class="btn show"> 
                                                <span class="badge badge-warning">{{$data->status}}</span>
                                            </button>
                                        
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap">
                                                <!-- <button type="submit" class="btn btn-small btn-secondary mr-1" data-toggle="modal" data-target="#edit-modal" data-id="{{ $data->id }}"><i class="fas fa-edit"></i></button> -->
                                                
                                                <button type="submit" class="btn btn-danger deleteBtn" data-toggle="modal" data-target="#DeleteModal" data-id="{{ $data->id }}"><i class="fas fa-trash"></i></button>
                                        
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Property Name</th>
                                        <th>Unavaliable From</th>
                                        <th>Unavaliable To</th>
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
        <!-- /.end country container-fluid -->
    </section>
    <!-- /.end country details -->
</div>

<!-- start delete modal -->
<div class="modal fade" id="DeleteModal">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Confirm Delete</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>Type <strong>delete</strong> to confirm:</p>
                <div class="form-group">
                    <input class="form-control" maxlength="6" required type="text" id="deleteConfirmationInput"/>
                </div>
                <div class="mt-2">
                    <p>This action is irreversible. Are you sure you want to permanently delete this property unavaliable dates?</p>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancel</button>
              <button type="button" id="confirmDeleteBtn" class="btn btn-outline-light">Delete</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /. end delete modal -->
@endsection

@push('plugin-scripts')
  
@endpush
@push('custom-scripts')
<script>
    $(document).ready(function () 
    {
        var deleteFormId;

        $(function () {
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            });

            $("#dates-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#dates-table_wrapper .col-md-6:eq(0)');
            
        });

        // activate or deactivate unavaliable dates 
        $('#dates-table').on('click', '.show', function () 
        {
            var button = $(this); // Store the clicked button for future reference
            var id = $(this).data('id');
            var spanElement = $(this).find('span');

            $.ajax({
                url: '{{ route("update-property-unavaliability-status", ["id" => ":id"]) }}'.replace(':id', id),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) 
                {
                    if (response.status == 'success') 
                    {
                        if (response.new_status == 'active') 
                        {
                            
                            // Replace text and class of the span
                            spanElement.text('active').removeClass('badge badge-warning').addClass('badge badge-success');

                            toastr.success('The unavaliable date is now active');
                        } 
                        else 
                        {
                        
                            // Replace text and class of the span
                            spanElement.text('inactive').removeClass('badge badge-success').addClass('badge badge-warning');
                        
                            toastr.warning('The unavaliable date is now inactive');
                        }
                    } 
                    else
                    {
                        // Handle the error
                        toastr.error('error occurred and response status is not success');
                    }
                },
                error: function(xhr, status, error) 
                {
                    // Handle the error response, show an error message
                    toastr.error(error);
                }
            });
        });

        // assign an ID to be deleted
        $('#dates-table').on('click', '.deleteBtn', function () {
            event.preventDefault(); // Prevent the default form submission

            deleteFormId = $(this).data('id'); // Store the form ID in the deleteFormId variable

            console.log(deleteFormId);
        });

        // handle delete
        $("#confirmDeleteBtn").click(function (e) 
        {
            e.preventDefault();

            // check if the user correctly typed delete
            var deleteConfirmationInput = $('#deleteConfirmationInput').val().trim().toLowerCase();


            if (deleteConfirmationInput === 'delete') 
            {

                // Send an AJAX request to delete the item
                $.ajax({
                    url: '{{ route("delete-unavaliable-date", ["id" => ":id"]) }}'.replace(':id', deleteFormId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Handle the success response

                        toastr.success(response.message);

                        // Reload the page after a delay of 2 seconds (2000 milliseconds)
                        setTimeout(function() {
                        location.reload();
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response, show an error message
                        toastr.error(error);
                    }
                });
            } 
            else 
            {
                toastr.error('Invalid delete confirmation');
            }

        });
    });
</script>
@endpush