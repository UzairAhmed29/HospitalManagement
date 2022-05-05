@extends('admin/layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Order ID: {{ $order->id }}</h1>
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
                                <input type="hidden" name="redirect_to_vendor" value="true">
                                <label><strong>Name </strong></label>
                                    <p>{{ $order->name }}</p>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="redirect_to_vendor" value="true">
                                <label><strong>email </strong></label>
                                    <p>{{ $order->email }}</p>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="redirect_to_vendor" value="true">
                                <label><strong>Phone </strong></label>
                                    <p>{{ $order->phone }}</p>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="redirect_to_vendor" value="true">
                                <label><strong>Address </strong></label>
                                    <p>{{ $order->address }}</p>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="redirect_to_vendor" value="true">
                                <label><strong>NIC </strong></label>
                                    <p>{{ $order->nic }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2>Order Details</h2>
                            <div class="form-group">
                                <label><strong>Vaccine Name </strong></label>
                                <p>{{ $order->vaccine->name }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Dose </strong></label>
                                <p>{{ ($order->dose) == 1 ? "Single" : "Double" }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Hospital </strong></label>
                                <p>{{ $order->vaccine->hospital->name }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Vaccination Date </strong></label>
                                <p>{{ $order->date }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Order Total </strong></label>
                                <p>Rs. {{ $order->orderTotal }}</p>
                            </div>
                        </div>
                        @if(auth()->user()->role == 'admin')
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <form name="updateOrderStatus" method="post" action="{{ route('update_order_status', $order->id) }}">
                                @csrf
                                @method('PUT')
                            <div class="form-group">
                                <label><strong>Order Status </strong></label>
                                <select class="form-control" name="order_status">
                                    <option value="On Hold" {{ ($order->order_status == 'On Hold') ? 'selected' : '' }}>On Hold</option>
                                    <option value="Processing" {{ ($order->order_status == 'Processing') ? 'selected' : '' }}>Processing</option>
                                    <option value="Completed" {{ ($order->order_status == 'Completed') ? 'selected' : '' }}>Completed</option>
                                    <option value="Cancelled" {{ ($order->order_status == 'Cancelled') ? 'selected' : '' }}>Cancelled</option>
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
