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
                                    <input id="orders" name="search" placeholder="Search Orders" class="form-control"  type="text" data-list=".orders">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >ID</th>
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >NIC</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Date of Vaccination</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Order Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="orders">
                                            @forelse($orders as $key => $order)
                                                <tr>
                                                    <td rowspan="1" colspan="1">{{ $order->id }}</td>
                                                    <td rowspan="1" colspan="1">{{ $order->name }}</td>
                                                    <td rowspan="1" acolspan="1">{{ $order->nic }}</td>
                                                    <td rowspan="1" acolspan="1">{{ $order->date }}</td>
                                                    <td rowspan="1" acolspan="1">{{ $order->order_status }}</td>
                                                    <td>
                                                        <form action="{{ route('order.destroy', $order->id) }}" method="POST" name="OrderDelete">
                                                            <a href="{{ route('order.show', $order->id) }}" class="btn btn-sm btn-default" title="Edit"><i class="fas fa-file-alt"></i></a>
                                                            @csrf
                                                            @method('DELETE')
                											@if(auth()->user()->role != "admin")
                                                            <button style="display: none;" type="submit" class="btn btn-sm btn-default" title="Delete" data-type="confirm"><i class="fa-solid fa-trash"></i></button>
                                                            @else
                                                                <button type="submit" class="btn btn-sm btn-default" title="Delete" data-type="confirm"><i class="fas fa-trash text-danger"></i></button>
                                                            @endif
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-danger">No Orders Found</div>
                                            @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="justify-content: end;">
                                <ul class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    {{ $orders->links() }}
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
            $('#orders').hideseek({  highlight: true});
        });
    });
    </script>
@endsection
