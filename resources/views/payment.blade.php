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
                    <h1>Payment Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Payment</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- payment details -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payment List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="payment-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Show on mobile</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td> {{$data->title}} </td>
                                        <td><img src="{{ asset('assets/uploads/category/'.$data->img) }}"  alt="category image" width="50" height="50"/></td>
                                        <td> 
                                            @if($data->show_on_mobile == 0)
                                               
                                                <button id="showOnMobileBtn" name="showOnMobileBtn" data-id="{{$data->id}}" class="btn btn-secondary btn-mobile"> 
                                                    <i class="fa fa-power-off"></i>
                                                </button>
                                                
                                            @else
                                                <button id="showOnMobileBtn" name="showOnMobileBtn" data-id="{{$data->id}}" class="btn btn-success btn-mobile"> 
                                                    <i class="fa fa-lock"></i>  
                                                </button>
                                    
                                            @endif
                                        </td>
                                        <td> {{$data->description}} </td>
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
                                                
                                                <!-- <button type="submit" class="btn btn-danger deleteBtn" data-toggle="modal" data-target="#DeleteModal" data-id="{{ $data->id }}"><i class="fas fa-trash"></i></button> -->
                                        
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
                                        <th>Show on mobile</th>
                                        <th>Description</th>
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
        <!-- /.end payment container-fluid -->
    </section>
    <!-- /.end payment details -->

</div>
<!-- /.content-wrapper -->

<!-- start edit modal -->
<div class="modal fade" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Payment Method Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="forms-sample" id="editForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" />

                    <div class="form-group">
                        <label for="inputName">Title</label>
                        <input type="text" id="title_edit" name="title_edit" class="form-control" required placeholder="Enter payment method title here"/>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Show on mobile</label>
                        <select id="show_on_mobile_edit" name="show_on_mobile_edit" class="form-control custom-select">
                            <option selected disabled>Select one</option>
                            <option value="1">True</option>
                            <option value="0">False</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Payment Description</label>
                        <textarea id="description_edit" name="description_edit" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="countryFlag">Payment Image</label>
                        <br />
                        <small style="color:red;"> leave blank if you do not wish to change payment image </small>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" placeholder="leave blank if you do not wish to change payment image" name="img_edit" id="img_edit"/>
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
                    <p>This action is irreversible. Are you sure you want to permanently delete this category?</p>
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
    {!! Html::script('assets/plugins/dropzone/min/dropzone.min.js') !!}
@endpush

@push('custom-scripts')
    <!-- DataTables  & Plugins -->
    <script>
        $(document).ready(function () 
        {
            $(function () {
                $("#payment-table").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#payment-table_wrapper .col-md-6:eq(0)');
            });

            // activate or deactivate mobile payment list
            $('.btn-mobile').click(function() {
                var button = $(this); // Store the clicked button for future reference
                var id = button.data('id');

                $.ajax({
                    url: '{{ route("update-mobile-payment-status", ["id" => ":id"]) }}'.replace(':id', id),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            if (response.new_status == 1) {
                                button.removeClass('btn-secondary').addClass('btn-success');
                                button.find('i').attr('class', 'fa fa-lock');
                                toastr.success('Payment method is now available on mobile');
                            } else {
                                button.removeClass('btn-success').addClass('btn-secondary');
                                button.find('i').attr('class', 'fa fa-power-off');

                                toastr.warning('Payment method has now been removed on mobile');
                            }
                        } else {
                            toastr.error('An error occurred and response status is not success');
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error(error);
                    }
                });
            });
           

            // assign an ID to be deleted
            $('#payment-table').on('click', '.deleteBtn', function () {
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
                        url: '{{ route("delete-category", ["id" => ":id"]) }}'.replace(':id', deleteFormId),
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
            $('#payment-table').on('click', '.mr-1', function () 
            {
                var itemId = $(this).data('id');

                // Make AJAX request to fetch item details
                $.ajax({
                    url: '{{ route("load-payment-details", ["id" => ":id"]) }}'.replace(':id', itemId),
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {

                        // Populate the form fields with fetched data
                        $('#id').val(response.data.id);
                        $('#title_edit').val(response.data.title);
                        $('#show_on_mobile_edit').val(response.data.show_on_mobile);
                        $('#description_edit').val(response.data.description);
                        $('#status_edit').val(response.data.status).trigger('change');

                    },
                    error: function(xhr, status, error) {
                        toastr.error(error);
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
                    url: '{{route("update-payment")}}',
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
                    }
                });
            });

            // DropzoneJS Demo Code Start
            Dropzone.autoDiscover = false

            // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
            var previewNode = document.querySelector("#template")
            previewNode.id = ""
            var previewTemplate = previewNode.parentNode.innerHTML
            previewNode.parentNode.removeChild(previewNode)

            var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "/target-url", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
            })

            myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
            })

            // Update the total progress bar
            myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
            })

            myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
            })

            // Hide the total progress bar when nothing's uploading anymore
            myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0"
            })

            // Setup the buttons for all transfers
            // The "add files" button doesn't need to be setup because the config
            // `clickable` has already been specified.
            document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
            }
            document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true)
            }
            // DropzoneJS Demo Code End

        });

    </script>
@endpush
