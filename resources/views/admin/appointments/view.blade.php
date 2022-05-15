@extends('admin/layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row clearfix">
			<div class="col-lg-12">
				<div class="card">
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-8">
                                </div>
                                <div class="col-sm-4" style="margin-bottom: 20px;">
                                    <input id="appointments" name="search" placeholder="Search Appointments" class="form-control"  type="text" data-list=".appointments">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">User</th>
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Doctor</th>
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Hospital</th>
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Appointment Date</th>
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="appointments">
                                            @forelse($appointments as $key => $appointment)
                                                <tr>
                                                    <td rowspan="1" colspan="1"><a href="{{ route('user.edit', $appointment->user->id) }}">{{ $appointment->user->name }}</a></td>
                                                    <td rowspan="1" colspan="1"><a href="{{ route('doctor.edit', $appointment->doctor->id) }}">{{ $appointment->doctor->name }}</a></td>
                                                    <td rowspan="1" colspan="1">{{ $appointment->hospital_name }}</td>
                                                    <td rowspan="1" colspan="1">{{ $appointment->app_date }}</td>
                                                    <td rowspan="1" colspan="1">{{ $appointment->status }}</td>
                                                    <td rowspan="1" colspan="1">
                                                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" name="appointmentDelete">
                                                            <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-sm btn-default" title="Edit"><i class="fas fa-file-alt"></i></a>
                                                            @csrf
                                                            @method('DELETE')
                                                            @if( auth()->user()->role == 'admin' )
                                                                <button type="submit" class="btn btn-sm btn-default" title="Delete" data-type="confirm"><i class="fas fa-trash text-danger"></i></button>
                                                            @endif
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-danger">No Appointment Found</div>
                                            @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="justify-content: end;">
                                <ul class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    {{ $appointments->links() }}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
    </section>
    <!-- /.content -->
  </div>

@endsection

@section('scripts')
  <script>
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#appointments').hideseek({  highlight: true});
        });
    });
    </script>
@endsection
