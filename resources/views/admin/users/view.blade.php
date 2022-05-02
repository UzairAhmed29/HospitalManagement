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
                                    <input id="users" name="search" placeholder="Search Users" class="form-control"  type="text" data-list=".users">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Role</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="users">
                                            @forelse($users as $key => $user)
                                                <tr>
                                                    <td rowspan="1" colspan="1">{{ $user->name }}</td>
                                                    <td rowspan="1" acolspan="1">{{ $user->email }}</td>
                                                    <td rowspan="1" colspan="1">
                                                        @if( $user->role == 'admin'  )
                                                            Administrator
                                                        @elseif( $user->role == 'vendor' )
                                                            vendor
                                                        @else
                                                            Customer
                                                        @endif
                                                    </td>
                                                    <td rowspan="1" colspan="1">
                                                        <form action="{{ route('UserStatus', $user->id) }}" name="UserStatus" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            @if($user->status == 'Deactivated')
                                                                <button type="submit" class="badge badge-warning  ml-0 mr-0">Deactivated</button>
                                                            @else
                                                                <button type="submit" class="badge badge-success  ml-0 mr-0"
                                                                @if(auth()->user()->id  == $user->id)
                                                                disabled
                                                                @endif
                                                                >Activated</button>
                                                            @endif
                                                        </form>
                                                    </td>
                                                    <td rowspan="1" colspan="1">
                                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" name="UserDelete">
                                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit"></i></a>
                                                            @csrf
                                                            @method('DELETE')
                											@if(auth()->user()->id  == $user->id)
                                                            <button style="display: none;" type="submit" class="btn btn-sm btn-default" title="Delete" data-type="confirm"><i class="fa-solid fa-trash"></i></button>
                                                            @else
                                                                <button type="submit" class="btn btn-sm btn-default" title="Delete" data-type="confirm"><i class="fas fa-trash text-danger"></i></button>
                                                            @endif
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-danger">No Users Found</div>
                                            @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="justify-content: end;">
                                <ul class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    {{ $users->links() }}
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
            $('#users').hideseek({  highlight: true});
        });
    });
    </script>
@endsection
