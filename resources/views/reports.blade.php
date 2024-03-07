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
          <h1>Report Management</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a> </li>
            <li class="breadcrumb-item active">Reports</li>
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
                          <table id="report-table" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>S/N</th>
                                  <th> User Name</th>
                                  <th> User Email </th>
                                  <th> Property</th>
                                  <th>Message</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($reports as $data)
                                  <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> {{ $data->user->name }} </td>
                                    <td> {{ $data->user->email }} </td>
                                    <td> {{ $data->property_id }} </td>
                                    <td> {{ $data->message }} </td>
                                    <td>
                                      @if($data->status == 'resolved')
                                              
                                      <button id="resolveBtn" name="resolveBtn" data-id="{{$data->id}}" class="btn btn-white"> 
                                        <span class="badge badge-success">{{$data->status}}</span>
                                      </button>
                                              
                                      @else
                                      <button id="resolveBtn" name="resolveBtn" data-id="{{$data->id}}" class="btn btn-white"> 
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
                                  <th> User Name</th>
                                  <th> User Email </th>
                                  <th> Property</th>
                                  <th>Message</th>
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
<!-- /.content-wrapper -->


@endsection

@push('plugin-scripts')
    <!-- extra scripts -->
@endpush

@push('custom-scripts')
  <!-- DataTables  & Plugins -->
  <script>
    $(document).ready(function () {

      $(function () {
        $("#report-table").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "buttons": ["excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#report-table_wrapper .col-md-6:eq(0)');
      });

      // activate or deactivate mobile payment list
      $('#report-table').on('click', '#resolveBtn', function () 
      {
        var id = $(this).data('id');

        var statusText = $('#resolveBtn span').text();

        console.log(statusText);

        if (statusText == 'resolved') 
        {
            toastr.warning('This report has already been resolved.');
        } 
        else 
        {
            $.ajax({
                url: '{{ route("update-report-status", ["id" => ":id"]) }}'.replace(':id', id),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) 
                {
                    if (response.status == 'success') 
                    {
                        $('#resolveBtn').removeClass('btn-white').addClass('btn-white');
                        var injected = '<span class="badge badge-success">resolved</span>';
                        $('#resolveBtn').html(injected);

                        toastr.success('This report has now been successfully resolved');
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
        }

        
      });

    });

  </script>
@endpush


