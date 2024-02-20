@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
    <div class="col-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title" style="text-align: center;">Change Password</h3>
                <form class="forms-sample" action="{{route('change-password')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Enter new password</label>
                        <div class="col-sm-9">
                            <input type="password" required class="form-control" name="password" id="password" placeholder="*********">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Re-enter password</label>
                        <div class="col-sm-9">
                            <input type="password" required class="form-control" name="password_confirmation" id="password_confirmation" placeholder="********">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
  {!! Html::script('/assets/js/dashboard.js') !!}
@endpush