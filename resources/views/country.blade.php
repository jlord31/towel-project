@extends('layout.master')

@push('plugin-styles')
    <!-- DataTables -->
    {!! Html::style('/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}
    {!! Html::style('/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}
    {!! Html::style('/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') !!}
@endpush


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Country</h1>
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
                            <input type="text" id="name" name="name" class="form-control" required placeholder="Enter country name here">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Country Code</label>
                            <input type="text" id="code" name="code" class="form-control" required placeholder="Enter country code here">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Country colour Flag</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" required name="img" id="img">
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
                <input type="submit" value="Add" class="btn btn-success float-right">
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
                            <table id="example1" class="table table-bordered table-striped">
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
                                        <td> {{$data->status}} </td>
                                        <td>
                                            <div class="d-flex flex-wrap">
                                                <button type="submit" class="btn btn-small btn-secondary mr-1" data-toggle="modal" data-target="#editModal" data-id="{{ $data->id }}"><i class="fas fa-edit"></i></button>
                                                
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
                <input type="text" id="id" name="id" /> 
                <p>Type <strong>delete</strong> to confirm:</p>
                <div class="form-group">
                    <input class="form-control" maxlength="6" type="text" id="deleteConfirmationInput">
                </div>
                <div class="mt-2">
                    <p>This action is irreversible. Are you sure you want to permanently delete this department?</p>
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
    {!! Html::script('/assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}
    {!! Html::script('/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}
    {!! Html::script('/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}
    {!! Html::script('/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') !!}
    {!! Html::script('/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') !!}
    {!! Html::script('/assets/plugins/jszip/jszip.min.js') !!}
    {!! Html::script('/assets/plugins/pdfmake/pdfmake.min.js') !!}
    {!! Html::script('/assets/plugins/pdfmake/vfs_fonts.js') !!}
    {!! Html::script('/assets/plugins/datatables-buttons/js/buttons.html5.min.js') !!}
    {!! Html::script('/assets/plugins/datatables-buttons/js/buttons.print.min.js') !!}
    {!! Html::script('/assets/plugins/datatables-buttons/js/buttons.colVis.min.js') !!}
@endpush

@push('custom-scripts')
    <!-- DataTables  & Plugins -->
    <script>
        $(document).ready(function () {
            $(function () {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });

            // handle delete
            $("#confirmDeleteBtn").click(function (e) 
            {
                e.preventDefault();

                // check if the user correctly typed delete
                var deleteConfirmationInput = $('#deleteConfirmationInput').val().trim().toLowerCase();

                console.log(deleteConfirmationInput);

                var deleteId = $(this).data('id');

                console.log(deleteId);

                // if (deleteConfirmationInput === 'delete') 
                // {
                //     var deleteId = $(this).data('id');

                //     // Send an AJAX request to delete the item
                //     $.ajax({
                //         url: '{{ route("login", ["id" => ":id"]) }}'.replace(':id', deleteId),
                //         type: 'DELETE',
                //         data: {
                //             _token: '{{ csrf_token() }}'
                //         },
                //         success: function(response) {
                //             // Handle the success response

                //             if (response.success) 
                //             {
                //                 toastr.success(response.success);
                //             } 
                //             else 
                //             {
                //                 toastr.error(response.error);
                //             }

                //             // Close the delete modal
                //             $('.uk-modal-close').trigger('click');

                //             // Reload the page after a delay of 2 seconds (2000 milliseconds)
                //             setTimeout(function() {
                //             location.reload();
                //             }, 2000);
                //         },
                //         error: function(xhr, status, error) {
                //             // Handle the error response, e.g., show an error message
                //             toastr.error(error);
                            
                //             // Close the delete modal
                //             $('.uk-modal-close').trigger('click');

                //         }
                //     });
                // } 
                // else 
                // {
                //     toastr.error('Invalid delete confirmation');

                //     // Close the delete modal
                //     $('.uk-modal-close').trigger('click');

                // }

            });
        });

    </script>
@endpush
