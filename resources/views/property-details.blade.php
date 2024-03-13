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
                        <li class="breadcrumb-item">
                            <a href="{{ route('view-property') }}">Property List</a> 
                        </li>
                        <li class="breadcrumb-item active"> Property Details </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
            <div class="row">
                <div class="col-12"> 
                <div class="card card-primary card-outline">
            
            <!-- /.card-header -->
            <div class="card-body p-0">
              
              
              <div class="mailbox-read-message">
                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Property Name/Title:</strong>
                    {{$property->title}}
                </div>
                
                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Country:</strong>
                    {{$property->country->name}}
                </div>

                <div class="col mb-3">
                    <strong class="fs-8 mr-2">City:</strong>
                    {{$property->city}}
                </div>

                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Address:</strong>
                    {{$property->address}}
                </div>
                
                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Bedroom:</strong>
                    {{$property->beds}}
                </div>

                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Bathroom:</strong>
                    {{$property->bathroom}}
                </div>

                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Number of guest allowed:</strong>
                    {{$property->people_limit}}
                </div>

                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Property Category:</strong>
                    {{$property->category->title}}
                </div>

                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Property Latitude:</strong>
                    {{$property->latitude}}
                </div>

                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Property Longtitude:</strong>
                    {{$property->longtitude}}
                </div>

                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Price Display to Customers:</strong>
                    {{$property->customer_price}}
                </div>

                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Actual Price:</strong>
                    {{$property->actual_price}}
                </div>

                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Profit for Company:</strong>
                    {{$property->company_profit}}
                </div>

                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Property Description:</strong>
                    {!!$property->description!!}
                </div>

                <div class="col mb-3">
                    <strong class="fs-8 mr-2">Status:</strong>
                    {{$property->status}}
                </div>

              </div>
             
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white">
              <ul class="mailbox-attachments d-flex align-items-stretch clearfix" style="flex-wrap: wrap;">
                
                <li>
                    <img src="{{ asset('assets/uploads/properties/'.$property->image) }}" width="200" height="150" alt="Attachment">
                    
                </li>

                @foreach($propertyImages as $prop)
                <li>
                    <img src="{{ asset('assets/uploads/properties/'.$prop->image) }}" width="200" height="150" alt="Attachment">
                </li>
                @endforeach
              </ul>
            </div>
            <!-- /.card-footer -->
            <div class="card-footer">
              <button type="button" class="btn btn-info editBtn"><i class="fas fa-edit"></i> Edit</button>
              <button type="button" class="btn btn-danger deleteBtn" data-toggle="modal" data-target="#DeleteModal"><i class="far fa-trash-alt"></i> Delete</button>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
                </div> 
            </div> 
        </div> 
    </section>
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
                    <p>This action is irreversible. Are you sure you want to permanently delete this property?</p>
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
        var propertyId = "{{ $property->id }}";

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
                    url: '{{ route("delete-property", ["id" => ":id"]) }}'.replace(':id', propertyId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Handle the success response

                        toastr.success(response.message);

                        // Redirect to the route
                        window.location.href = "{{ route('view-property') }}";

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

        $(".editBtn").click(function (e)
        {
            window.location.href = "{{ route('edit-property', ['id' => $property->id]) }}";
        });
    });

</script>
@endpush

