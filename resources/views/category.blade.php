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
                        <li class="breadcrumb-item active">Categories</li>
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
                        <h3 class="card-title">General</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Project Name</label>
                            <input type="text" id="inputName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Project Description</label>
                            <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Status</label>
                            <select id="inputStatus" class="form-control custom-select">
                                <option selected disabled>Select one</option>
                                <option>On Hold</option>
                                <option>Canceled</option>
                                <option>Success</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Client Company</label>
                            <input type="text" id="inputClientCompany" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputProjectLeader">Project Leader</label>
                            <input type="text" id="inputProjectLeader" class="form-control">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Add" class="btn btn-success float-right">
            </div>
        </div>
    </section>
    <!-- /.end add country section -->

    <!-- country details -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>
                                        <th>Engine version</th>
                                        <th>CSS grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Trident</td>
                                        <td>Internet
                                            Explorer 4.0
                                        </td>
                                        <td>Win 95+</td>
                                        <td> 4</td>
                                        <td>X</td>
                                    </tr>
                                    <tr>
                                        <td>Misc</td>
                                        <td>NetFront 3.4</td>
                                        <td>Embedded devices</td>
                                        <td>-</td>
                                        <td>A</td>
                                    </tr>
                                    <tr>
                                        <td>Misc</td>
                                        <td>Dillo 0.8</td>
                                        <td>Embedded devices</td>
                                        <td>-</td>
                                        <td>X</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>
                                        <th>Engine version</th>
                                        <th>CSS grade</th>
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
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
        });

    </script>
@endpush
