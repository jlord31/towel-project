@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
<style> 

    /* Remove white background and padding from modal body */
    .modal-body {
        background-color: transparent !important;
        padding: 0 !important;
    }

    /* Restrict the modal body to the size of the images */
    .carousel-inner {
        margin: 0;
        justify-content: center;
        align-items: center;
    }

    .carousel-item img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: auto;
    }

    /* .carousel-item {
        text-align: center;
    }

    .carousel-item img {
        max-width: 400px;
        max-height: 400px;
        width: auto;
        height: auto;
    } */

    /* Remove background color from carousel controls */
    .carousel-control-prev,
    .carousel-control-next {
        background: none;
        border: none;
        color: transparent !important;
    }

    /* Add some margin to the controls */
    .carousel-control-prev {
        margin-left: -60px; /* Adjust as needed */
    }

    .carousel-control-next {
        margin-right: -60px; /* Adjust as needed */
    }

    /* Add red background to delete button */
    .delete-btn {
        background-color: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        position: absolute;
        top: -5px;
        right: -5px;
        cursor: pointer;
        transform-origin: center;
        transform: rotate(-45deg);
    }


    .carousel-item {
        position: relative;
    }

</style>

@endpush


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Property List</h1>
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
                                    <th>Facilities</th>
                                    <th>Company Profit</th>
                                    <th>Status</th>
                                    <th> Action </th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($properties as $data)
                                    <tr> 
                                        <td>{{ $loop->iteration }}</td>
                                        <td> {{ $data->title }} </td>
                                        <td>
                                            <img class="main-image" src="{{ asset('assets/uploads/properties/'.$data->image) }}" data-property-id="{{ $data->id }}" alt="property image" width="100" height="120"/>
                                        </td>
                                        <td> {{ $data->category->title }} </td>
                                        <td> {{ $data->address }} </td>
                                        @php
                                            $facilities = explode(',', $data->facility);
                                        @endphp
                                        <td> 
                                            @foreach ($facilities as $value)
                                                <span class="badge badge-dark tag-pills-sm-mb mr-1 mb-1">{{ trim($value) }}</span>
                                            @endforeach
                                        </td>
                                        <td> {{ $data->company_profit }} </td>
                                        <td>
                                            @if($data->status == 'active')
                                                    
                                            <button id="resolveBtn-{{ $data->id }}" name="resolveBtn-{{ $data->id }}" data-id="{{$data->id}}" class="btn btn-white"> 
                                                <span class="badge badge-success">{{$data->status}}</span>
                                            </button>
                                                    
                                            @else
                                            <button id="resolveBtn-{{ $data->id }}" name="resolveBtn-{{ $data->id }}" data-id="{{$data->id}}" class="btn btn-white"> 
                                                <span class="badge badge-warning">{{$data->status}}</span>
                                            </button>
                                        
                                            @endif
                                        </td>  
                                        <td>  
                                            <div class="d-flex flex-wrap">
                                                <a href="{{ route('property-details', ['id' => $data->id]) }}" class="btn btn-small btn-info mr-1"> <i class="fas fa-eye"></i></a>
                                            </div>
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
                                    <th>Facilities</th>
                                    <th>Company Profit</th>
                                    <th>Status</th>
                                    <th> Action </th>
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


<!-- Modal begin here -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div id="imageSlider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Images will be populated dynamically here -->
                    </div>
                    <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end here -->


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

      $('#property-table').on('click', '.main-image', function () 
        {
            var propertyId = $(this).data('property-id');

            // Make AJAX request to fetch all related images
            $.ajax({
                url: '{{ route("fetch-property-images", ["id" => ":id"]) }}'.replace(':id', propertyId),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) 
                {
                    // Get the base source of the image without the file name
                    var baseSrc = '{{ asset('assets/uploads/properties') }}';

                    // Populate the modal carousel with images
                    var carouselInner = $('#imageSlider .carousel-inner');
                    carouselInner.empty();
                    response.data.forEach(function (imageUrl, index) {
                        // get the full image url
                        var fullImageUrl = baseSrc + '/' + imageUrl.image;

                        var itemClass = index === 0 ? 'carousel-item active' : 'carousel-item';
                        var deleteButton = '<button type="button" class="delete-btn" data-index="' + imageUrl.id + '">X</button>';
                        var imageHtml = '<div class="' + itemClass + '"><img src="' + fullImageUrl + '" class="d-block w-100"/><div class="delete-container">' + deleteButton + '</div></div>';
                        //carouselInner.innerHTML += imageHtml;
                        //var imageHtml = '<div class="' + itemClass + '"><img src="' + fullImageUrl + '" alt="Property Image"></div>';
                        carouselInner.append(imageHtml);
                    });
                },
                error: function (xhr, status, error) 
                {
                    console.error(error);
                    console.log(xhr);
                }
            });

            // Trigger the modal
            $('#imageModal').modal('show');
        });

        // Add click event listener to delete button
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var index = parseInt(this.getAttribute('data-index'));
                // Delete the image from the array
                images.splice(index, 1);
                // Remove the corresponding carousel item
                var carouselItem = this.closest('.carousel-item');
                carouselItem.parentNode.removeChild(carouselItem);
            });
        });

    
    });

  </script>
@endpush

