@extends('admin/layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Appointment ID: {{ $appointment->id }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Personal Detail</h2>
                            <div class="form-group">
                                <label><strong>Name </strong></label>
                                    <p>{{ $appointment->user->name }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>email </strong></label>
                                    <p>{{ $appointment->user->email }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Phone </strong></label>
                                    <p>{{ $appointment->user_phone }}</p>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <h2>Appointment Details</h2>
                            <div class="form-group">
                                <label><strong>Doctor Name </strong></label>
                                <p>{{ $appointment->doctor->name }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Hospital </strong></label>
                                <p>{{ $appointment->hospital_name }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Consultation Fee </strong></label>
                                <p>{{ $appointment->fee }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Appointment Date</strong></label>
                                <p> {{ $appointment->app_day . " " . $appointment->app_date }}</p>
                            </div>
                        </div>
                        @if(auth()->user()->role == 'admin')
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <form name="updateAppStatus" method="post" action="{{ route('update_app_status', $appointment->id) }}">
                                @csrf
                                @method('PUT')
                            <div class="form-group">
                                <label><strong>Order Status </strong></label>
                                <select class="form-control" name="status">
                                    <option value="On Hold" {{ ($appointment->status == 'On Hold') ? 'selected' : '' }}>On Hold</option>
                                    <option value="Processing" {{ ($appointment->status == 'Processing') ? 'selected' : '' }}>Processing</option>
                                    <option value="Completed" {{ ($appointment->status == 'Completed') ? 'selected' : '' }}>Completed</option>
                                    <option value="Cancelled" {{ ($appointment->status == 'Cancelled') ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <button class="btn btn btn-outline-success" type="submit">Update</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>

@endsection
