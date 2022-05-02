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
                <form action="{{ isset($vaccine) ? route('vaccine.update', $vaccine->id) : route('vaccine.store') }}" method="POST" name="VaccineCreateUpdate" enctype="multipart/form-data">
                    @csrf
                    @isset ($vaccine)
                        @method('PUT')
                    @endisset
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Vaccine Name <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="name" value="{{ isset($vaccine->name) ? $vaccine->name : old('name') }}" placeholder="Vaccine Name">
                                    <span class="text-danger"><b>{{ $errors->first('name') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>Price <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="price" value="{{ isset($vaccine->price) ? $vaccine->price : old('price') }}" placeholder="Price">
                                    <span class="text-danger"><b>{{ $errors->first('price') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>Doses <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="doses" value="{{ isset($vaccine->doses) ? $vaccine->doses : old('doses') }}" placeholder="Doses">
                                    <span class="text-danger"><b>{{ $errors->first('doses') }}</b></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Hospital <span class="text-danger">*</span></strong></label>
                                    <select class="form-control" name="hospital_id">
                                        @foreach( $hospitals as $hospital )
                                            <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><b>{{ $errors->first('hospital_id') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>Effectiveness </strong></label>
                                    <input type="text" class="form-control" name="effective" value="{{ isset($vaccine->effective) ? $vaccine->effective : old('effective') }}" placeholder="Effectiveness">
                                    <span class="text-danger"><b>{{ $errors->first('effective') }}</b></span>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="picture" value="{{ isset($vaccine) ? $vaccine->picture : null }}">
                                    <label>Picture</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="picture" class="custom-file-input" id="inputGroupFile01" value="">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <a href="{{ route('vaccine.index') }}" class="btn btn btn-outline-danger">Cancel</a>
                                <button type="submit" class="btn btn btn-outline-success">
                                    @isset ($vaccine)
                                        Update
                                    @endisset
                                    @empty ($vaccine)
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
