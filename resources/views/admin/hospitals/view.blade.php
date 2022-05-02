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
                                    <input id="hospitals" name="search" placeholder="Search Hospitals" class="form-control"  type="text" data-list=".hospitals">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Hospital Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Phone</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Active Corona Cases</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Recovered Patients</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Total Deaths</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="hospitals">
                                            @forelse($hospitals as $key => $hospital)
                                                <tr>
                                                    <td rowspan="1" colspan="1">{{ $hospital->name }}</td>
                                                    <td rowspan="1" acolspan="1">{{ $hospital->phone }}</td>
                                                    <td rowspan="1" colspan="1">{{ $hospital->active_cases }}</td>
                                                    <td rowspan="1" colspan="1">{{ $hospital->recovered_patients }}</td>
                                                    <td rowspan="1" colspan="1">{{ $hospital->deaths }}</td>
                                                    <td rowspan="1" colspan="1">
                                                        <form action="{{ route('HospitalStatus', $hospital->id) }}" name="HospitalStatus" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            @if($hospital->status == 'Deactivated')
                                                                <button type="submit" class="badge badge-warning  ml-0 mr-0">Deactivated</button>
                                                            @else
                                                                <button type="submit" class="badge badge-success  ml-0 mr-0">Activated</button>
                                                            @endif
                                                        </form>
                                                    </td>
                                                    <td rowspan="1" colspan="1">
                                                        <form action="{{ route('hospital.destroy', $hospital->id) }}" method="POST" name="HoospitalDelete">
                                                            <a href="{{ route('hospital.edit', $hospital->id) }}" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit"></i></a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-default" title="Delete" data-type="confirm"><i class="fas fa-trash text-danger"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-danger">No Hospitals Found</div>
                                            @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="justify-content: end;">
                                <ul class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    {{ $hospitals->links() }}
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
            $('#hospitals').hideseek({  highlight: true});
        });
    });
    </script>
@endsection
