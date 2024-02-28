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
          <h1>User Management</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a> </li>
            <li class="breadcrumb-item active">Users</li>
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
                          <h3 class="card-title">User's List</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                          <table id="user-table" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>S/N</th>
                                  <th> Name</th>
                                  <th> Email</th>
                                  <th>Profile Image</th>
                                  <th>Mobile</th>
                                  <th>Join Date</th>
                                  <th>Status</th>
                                  <th>User Referral Code</th>
                                  <th>Referred By</th>
                                  <th>Amount Spent</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($users as $data)
                                  <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> {{ $data->name }} </td>
                                    <td> {{ $data->email }} </td>
                                    <td>
                                      <img class="img img-fluid rounded" src="{{ asset('assets/uploads/user/profile/'.$data->pro_pic) }}"
                                        alt="User profile" width="50" height="50" />
                                    </td>
                                    <td> {{ $data->mobile }} </td>
                                    <td> {{ $data->created_at }} </td>
                                    <td>
                                      @if($data->status == 'active')
                                              
                                      <button id="showOnMobileBtn" name="showOnMobileBtn" data-id="{{$data->id}}" class="btn btn-white"> 
                                        <span class="badge badge-success">{{$data->status}}</span>
                                      </button>
                                              
                                      @else
                                      <button id="showOnMobileBtn" name="showOnMobileBtn" data-id="{{$data->id}}" class="btn btn-white"> 
                                        <span class="badge badge-warning">{{$data->status}}</span>
                                      </button>
                                  
                                      @endif
                                    </td>
                                    <td> {{ $data->refercode }} </td>
                                    <td> {{ $data->parentcode }} </td>
                                    <td> ₦ 0 </td>     
                                  </tr>
                                @endforeach
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>S/N</th>
                                  <th> Name</th>
                                  <th> Email</th>
                                  <th>Profile Image</th>
                                  <th>Mobile</th>
                                  <th>Join Date</th>
                                  <th>Status</th>
                                  <th>User Referral Code</th>
                                  <th>Referred By</th>
                                  <th>Amount Spent</th>
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
        $("#user-table").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "buttons": ["excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#user-table_wrapper .col-md-6:eq(0)');
      });

      // activate or deactivate mobile payment list
      $("#showOnMobileBtn").click(function()
      {
        var id = $(this).data('id');

        $.ajax({
          url: '{{ route("update-user-status", ["id" => ":id"]) }}'.replace(':id', id),
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
                // Update the button to payment method is active on mobile
                
                $('#showOnMobileBtn').removeClass('btn-white').addClass('btn-white');
                var injected = '<span class="badge badge-success">active</span>';
                $('#showOnMobileBtn').html(injected);

                toastr.success('user is now active');
              } 
              else 
              {
                // Update the button so that payment is not shown on mobile
                
                $('#showOnMobileBtn').removeClass('btn-white').addClass('btn-white');
                // $('#'+staff_id).text("activate");
                var injected = '<span class="badge badge-warning">inactive</span>';
                $('#showOnMobileBtn').html(injected);

                toastr.warning('User is now inactive');
              }
            } 
            else
            {
              // Handle the error
              // console.log('error occurred and response status is not success');
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

    });

  </script>
@endpush
