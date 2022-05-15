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
                                    <input id="vaccines" name="search" placeholder="Search Vaccines" class="form-control"  type="text" data-list=".vaccines">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Hospital</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Price</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Doses</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Effective</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="vaccines">
                                            @forelse($vaccines as $key => $vaccine)
                                                <tr>
                                                    <td rowspan="1" colspan="1">{{ $vaccine->name }}</td>
                                                    <td rowspan="1" acolspan="1">{{ @$vaccine->hospital->name }}</td>
                                                    <td rowspan="1" colspan="1">{{ $vaccine->price }}</td>
                                                    <td rowspan="1" colspan="1">{{ $vaccine->doses }}</td>
                                                    <td rowspan="1" colspan="1">{{ $vaccine->effective }}</td>
                                                    <td rowspan="1" colspan="1">
                                                        <form action="{{ route('vaccine.destroy', $vaccine->id) }}" method="POST" name="VaccineDelete">
                                                            <a href="{{ route('vaccine.edit', $vaccine->id) }}" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit"></i></a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-default" title="Delete" data-type="confirm"><i class="fas fa-trash text-danger"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-danger">No Vaccines Found</div>
                                            @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="justify-content: end;">
                                <ul class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    {{ $vaccines->links() }}
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
            $('#vaccines').hideseek({  highlight: true});
        });
    });
    </script>
@endsection
