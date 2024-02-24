@extends('layout.master')

@push('plugin-styles')
    <!-- extra styles -->
@endpush


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Country Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Country</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- add country section -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Country</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('country')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                        <div class="form-group">
                            <label for="inputName">Country Name</label>
                            <input type="text" id="name" name="name" class="form-control" required placeholder="Enter country name here"/>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Country Code</label>
                            <input type="text" id="code" name="code" class="form-control" required placeholder="Enter country code here">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Country colour Flag</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" required name="img" id="img"/>
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
    <!-- /.end add country section -->


    <!-- country details -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Country List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="country-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Country Name</th>
                                        <th>Country Code</th>
                                        <th>Flag</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($country as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td> {{$data->name}} </td>
                                        <td> {{$data->code}} </td>
                                        <td><img src="{{ asset('assets/uploads/country/flags/'.$data->img) }}"  alt="country flag" width="50" height="25"/></td>
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
                                        <th>Country Name</th>
                                        <th>Country Code</th>
                                        <th>Flag</th>
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
<!-- /.content-wrapper -->

<!-- start edit modal -->
<div class="modal fade" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Country Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="forms-sample" id="editForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" />

                    <div class="form-group">
                        <label for="inputName">Country Name</label>
                        <input type="text" id="name_edit" name="name_edit" class="form-control" required placeholder="Enter country name here"/>
                    </div>
                    <div class="form-group">
                        <label for="inputName">Country Code</label>
                        <input type="text" id="code_edit" name="code_edit" class="form-control" required placeholder="Enter country code here"/>
                    </div>
                    <div class="form-group">
                        <label for="countryFlag">Country colour Flag</label>
                        <br />
                        <small style="color:red;"> leave blank if you do not wish to change country flag </small>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" placeholder="leave blank if you do not wish to change country flag" name="img_edit" id="img_edit"/>
                                <label class="custom-file-label" for="countryFlag">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <select id="status_edit" name="status_edit" class="form-control custom-select">
                            <option selected disabled>Select one</option>
                            <option>active</option>
                            <option>inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.end edit modal -->

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
                    <p>This action is irreversible. Are you sure you want to permanently delete this country?</p>
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
    <!-- extra scripts -->
@endpush

@push('custom-scripts')
    <!-- DataTables  & Plugins -->
    <script>
        $(document).ready(function () {
            var deleteFormId;

            $(function () {
                $("#country-table").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#country-table_wrapper .col-md-6:eq(0)');
            });

            // assign an ID to be deleted
            $('#country-table').on('click', '.deleteBtn', function () {
                event.preventDefault(); // Prevent the default form submission

                deleteFormId = $(this).data('id'); // Store the form ID in the deleteFormId variable
                
                // $('#confirmDeleteBtn').data('id', formId); // Store the form ID in the confirm delete button
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
                        url: '{{ route("delete-country", ["id" => ":id"]) }}'.replace(':id', deleteFormId),
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

            // Event handler for edit button click
            $('#country-table').on('click', '.mr-1', function () 
            {
                var itemId = $(this).data('id');

                // Make AJAX request to fetch item details
                $.ajax({
                    url: '{{ route("load-country-details", ["id" => ":id"]) }}'.replace(':id', itemId),
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {

                        // Populate the form fields with fetched data
                        $('#id').val(response.data.id);
                        $('#name_edit').val(response.data.name);
                        $('#code_edit').val(response.data.code);
                        $('#status_edit').val(response.data.status).trigger('change');

                    },
                    error: function(xhr, status, error) {
                        toastr.error(error);
                        console.log(xhr);
                        // // Close the delete modal
                        $('#editModal').modal('hide');
                    }
                });
            });

            //Event handler to save form edit
            $('#editForm').submit(function(e) 
            {
                e.preventDefault();

                var formData = new FormData(this); // Pass the form element here

                //console.log([..formData]);
                
                // Perform AJAX request to update university data
                $.ajax({
                    url: '{{route("update-country")}}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(response) {
                        // Handle success response
                        if (response.status == 'success') 
                        {
                            toastr.success(response.data);
                        } 
                        else 
                        {
                            toastr.error(response.data);
                        }

                        // Reload the page after a delay of 2 seconds (2000 milliseconds)
                        setTimeout(function() {
                        location.reload();
                        }, 2000);

                    },
                    error: function(xhr, status, error) {
                        toastr.error(error);
                        console.log(xhr);
                    }
                });
            });
        });    
    </script>
@endpush