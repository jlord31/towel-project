@extends('layout.master')

@push('plugin-styles')
    <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->

    <!-- dropzonejs -->
    {!! Html::style('assets/plugins/dropzone/min/dropzone.min.css') !!}
@endpush


@section('content')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Property Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Properties</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- add coupon section -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Coupon</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- <form id="property-form" action="{{ route('upload-property') }}" enctype="multipart/form-data"
                            method="POST"> -->
                        <form id="property-form">
                            @csrf
                            <div class="form-group">
                                <label for="inputName">Title</label>
                                <input type="text" id="title" name="title" class="form-control" required
                                    placeholder="Enter title here" />
                            </div>

                            
                            <div class="form-group">
                                <label for="inputStatus">Status</label>
                                <select id="status" name="status" class="form-control custom-select">
                                    <option selected disabled>Select one</option>
                                    <option>active</option>
                                    <option>inactive</option>
                                </select>
                            </div>
                            <!-- <div class="form-group"> 
                              <input type="file" name="files[]" multiple>
                            </div> -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">Dropzone.js <small><em>jQuery File Upload</em> like
                                                    look</small></h3>
                                        </div>
                                        <div class="card-body">
                                            <div id="actions" class="row">
                                                <div class="col-lg-6">
                                                    <div class="btn-group w-100">
                                                        <span class="btn btn-success col fileinput-button">
                                                            <i class="fas fa-plus"></i>
                                                            <span>Add files</span>
                                                        </span>
                                                        <button type="submit" class="btn btn-primary col start">
                                                            <i class="fas fa-upload"></i>
                                                            <span>Start upload</span>
                                                        </button>
                                                        <button type="reset" class="btn btn-warning col cancel">
                                                            <i class="fas fa-times-circle"></i>
                                                            <span>Cancel upload</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 d-flex align-items-center">
                                                    <div class="fileupload-process w-100">
                                                        <div id="total-progress"
                                                            class="progress progress-striped active" role="progressbar"
                                                            aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                            <div class="progress-bar progress-bar-success"
                                                                style="width:0%;" data-dz-uploadprogress></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table table-striped files" id="previews">
                                              <div id="template" class="row mt-2">
                                                <div class="col-auto">
                                                    <span class="preview"><img src="data:," alt=""
                                                            data-dz-thumbnail /></span>
                                                </div>
                                                <div class="col d-flex align-items-center">
                                                  <p class="mb-0">
                                                    <span class="lead" data-dz-name></span>
                                                    (<span data-dz-size></span>)
                                                  </p>
                                                  <strong class="error text-danger" data-dz-errormessage></strong>
                                                </div>
                                                <div class="col-4 d-flex align-items-center">
                                                  <div class="progress progress-striped active w-100"
                                                        role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                                        aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success"
                                                            style="width:0%;" data-dz-uploadprogress></div>
                                                  </div>
                                                </div>
                                                <div class="col-auto d-flex align-items-center">
                                                  <div class="btn-group">
                                                    <button class="btn btn-primary start">
                                                      <i class="fas fa-upload"></i>
                                                      <span>Start</span>
                                                    </button>
                                                    <button data-dz-remove class="btn btn-warning cancel">
                                                      <i class="fas fa-times-circle"></i>
                                                      <span>Cancel</span>
                                                    </button>
                                                    <button data-dz-remove class="btn btn-danger delete">
                                                      <i class="fas fa-trash"></i>
                                                      <span>Delete</span>
                                                    </button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.card -->
                                </div>
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
                <input type="button" value="Add" class="btn btn-success float-right" id="submit-btn"/>
            </div>
        </div>
        </form>
    </section>
    <!-- /.end add coupon section -->

</div>
@endsection
@endsection

@push('plugin-scripts')
    {!! Html::script('assets/plugins/dropzone/min/dropzone.min.js') !!}
@endpush
@push('custom-scripts')
    <!-- DataTables  & Plugins -->
    <script>
        $(document).ready(function () {
            $(function () {
                $("#payment-table").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#payment-table_wrapper .col-md-6:eq(0)');
            });



            // DropzoneJS Demo Code Start
            Dropzone.autoDiscover = false

            // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
            var previewNode = document.querySelector("#template")
            previewNode.id = ""
            var previewTemplate = previewNode.parentNode.innerHTML
            previewNode.parentNode.removeChild(previewNode)

            var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
                url: "{{ route('upload-property') }}", // Set the url
                thumbnailWidth: 80,
                thumbnailHeight: 80,
                parallelUploads: 20,
                previewTemplate: previewTemplate,
                autoQueue: false, // Make sure the files aren't queued until manually added
                previewsContainer: "#previews", // Define the container to display the previews
                clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
            })

            // Function to add queued files to the form data
            function addQueuedFilesToFormData(formData) {
                myDropzone.files.forEach(function (file, index) {
                    formData.append('files[' + index + ']', file);
                });
            }

            myDropzone.on("addedfile", function (file) {
                // Hookup the start button
                file.previewElement.querySelector(".start").onclick = function () {
                    myDropzone.enqueueFile(file)
                }
            })

            // Update the total progress bar
            myDropzone.on("totaluploadprogress", function (progress) {
                document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
            })

            myDropzone.on("sending", function (file) {
                // Show the total progress bar when upload starts
                document.querySelector("#total-progress").style.opacity = "1"
                // And disable the start button
                file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
            })

            // Hide the total progress bar when nothing's uploading anymore
            myDropzone.on("queuecomplete", function (progress) {
                document.querySelector("#total-progress").style.opacity = "0"
            })

            // Setup the buttons for all transfers
            // The "add files" button doesn't need to be setup because the config
            // `clickable` has already been specified.
            document.querySelector("#actions .start").onclick = function () {
                myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
            }
            document.querySelector("#actions .cancel").onclick = function () {
                myDropzone.removeAllFiles(true)
            }

            Dropzone.options.myAwesomeDropzone = {
                // ... other Dropzone options ...
                success: function(file, response) {
                    console.log("File uploaded successfully:", file, response);
                    // Access uploaded file information from 'file' object
                    //  - file.name: original filename
                    //  - file.size: file size in bytes
                    //  - response (optional): server response data (might contain additional information)
                }
            };
            // DropzoneJS Demo Code End

            // Submit button click handler
            
            // Submit form with queued files
            $('#submit-btn').click(function (e) {
                e.preventDefault();

                // Create FormData object
                var formData = new FormData();

                // Add text inputs to FormData
                formData.append('title', $('#title').val());
                formData.append('status', $('#status').val());

                // Add queued files to FormData
                //addQueuedFilesToFormData(formData);

                // Submit form with FormData
                $.ajax({
                    url: "{{ route('upload-property') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function (response) {
                        // Handle success response
                    },
                    error: function (xhr, status, error) {
                        // Handle error response
                        console.log(xhr);
                    }
                });
            });

        });

    </script>
@endpush


