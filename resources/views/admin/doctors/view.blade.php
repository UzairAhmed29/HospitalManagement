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
                                    <input id="doctors" name="search" placeholder="Search Doctors" class="form-control"  type="text" data-list=".doctors">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Hospital Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Hospital</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Specialist</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Fee</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Timmings</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="doctors">
                                            @forelse($doctors as $key => $doctor)
                                                <tr>
                                                    <td rowspan="1" colspan="1">{{ $doctor->name }}</td>
                                                    <td rowspan="1" acolspan="1">{{ $doctor->hospital->name }}</td>
                                                    <td rowspan="1" colspan="1">
                                                        @php
                                                            $s = $doctor->specialist;
                                                            $spec = explode(",", $s);
                                                            foreach( $spec as $i ) {
                                                                $j = \App\Models\Services::find($i);
                                                                if( !empty($j) && $j != null ) {
                                                                    echo '<span style="background: #dbd9d9; padding: 3px 7px; color: black; border-radius: 50px; margin-left: 3px;">'.$j->name.'</span>';
                                                                }

                                                            }

                                                        @endphp

                                                    </td>
                                                    <td rowspan="1" colspan="1">{{ $doctor->fee }}</td>
                                                    <td rowspan="1" colspan="1">{{ $doctor->timming }}</td>
                                                    <td rowspan="1" colspan="1">
                                                        <form action="{{ route('doctor.destroy', $doctor->id) }}" method="POST" name="HoospitalDelete">
                                                            <a href="{{ route('doctor.edit', $doctor->id) }}" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit"></i></a>
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
                                    {{ $doctors->links() }}
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
            $('#doctors').hideseek({  highlight: true});
        });
    });
    </script>
@endsection
