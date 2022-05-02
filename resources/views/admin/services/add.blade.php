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
        <div class="container-fluid">
            <div class="card card-default">
                <form action="{{ isset($service) ? route('service.update', $service->id) : route('service.store') }}" method="POST" name="ServiceCreateUpdate">
                    @csrf
                    @isset ($service)
                        @method('PUT')
                    @endisset
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Service Name <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="name" value="{{ isset($service->name) ? $service->name : old('name') }}" placeholder="Service Name">
                                    <span class="text-danger"><b>{{ $errors->first('name') }}</b></span>
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <a href="{{ route('service.index') }}" class="btn btn btn-outline-danger">Cancel</a>
                                <button type="submit" class="btn btn btn-outline-success">
                                    @isset ($service)
                                        Update
                                    @endisset
                                    @empty ($service)
                                        Create
                                    @endempty
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>

@endsection
