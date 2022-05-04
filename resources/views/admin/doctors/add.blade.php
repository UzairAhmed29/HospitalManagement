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
                <form action="{{ isset($doctor) ? route('doctor.update', $doctor->id) : route('doctor.store') }}" method="POST" name="DoctorCreateUpdate" enctype="multipart/form-data">
                    @csrf
                    @isset ($doctor)
                        @method('PUT')
                    @endisset
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Doctor Name <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="name" value="{{ isset($doctor->name) ? $doctor->name : old('name') }}" placeholder="Doctor Name">
                                    <span class="text-danger"><b>{{ $errors->first('name') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>Expirience <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="expirience" value="{{ isset($doctor->expirience) ? $doctor->expirience : old('expirience') }}" placeholder="Expirience">
                                    <span class="text-danger"><b>{{ $errors->first('expirience') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>City <span class="text-danger">*</span></strong></label>
                                    <select class="form-control city" name="city">
                                        @foreach( $cities as $city )
                                            <option value="{{ $city }}"
                                            @if( isset($doctor) && $doctor->city === $city )
                                                selected
                                            @endif
                                            >{{ $city }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><b>{{ $errors->first('city') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>Timmings <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control daterange" name="timming" value="{{ isset($doctor->name) ? $doctor->name : old('name') }}" placeholder="Select Timming"/>
                                    <span class="text-danger"><b>{{ $errors->first('timming') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>Fee <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="fee" value="{{ isset($doctor->fee) ? $doctor->fee : old('fee') }}" placeholder="Fee">
                                    <span class="text-danger"><b>{{ $errors->first('fee') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label>Picture</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="picture" class="custom-file-input" id="inputGroupFile01" value="">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Hospital <span class="text-danger">*</span></strong></label>
                                    <select class="form-control" name="hospital_id" >
                                        @foreach( $hospitals as $hospital )
                                            <option value="{{ $hospital->id }}"
                                            @if( $doctor->hospital_id == $hospital->id )
                                                selected
                                            @endif
                                            >{{ $hospital->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><b>{{ $errors->first('hospital_id') }}</b></span>
                                </div>

                                <div class="form-group">
                                    <label><strong>Education <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="education" value="{{ isset($doctor->education) ? $doctor->education : old('education') }}" placeholder="Education">
                                    <span class="text-danger"><b>{{ $errors->first('education') }}</b></span>
                                </div>
                                <div class="form-group">
                                    @php
                                        $w = array();
                                        if(isset($doctor)) {
                                            $wor_days = $doctor->working_days;
                                            $w = explode(",", $wor_days);
                                        }
                                    @endphp
                                    <label><strong>Working Days <span class="text-danger">*</span></strong></label>
                                    <select class="form-control select2 working_days" name="working_days[]" multiple>
                                        @foreach( $working_days as $i => $wd )
                                            <option value="{{ $i }}"
                                            @if( in_array($i, $w) )
                                                selected
                                            @endif
                                            >{{ $wd }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><b>{{ $errors->first('working_days') }}</b></span>
                                </div>

                                <div class="form-group">
                                    @php
                                        $fac = @$doctor->services;
                                        $facilities = explode(",",$fac);
                                    @endphp
                                    <label><strong>Services <span class="text-danger">*</span></strong></label>
                                    <select class="form-control select2 facilities_services" name="services[]" multiple>
                                        @foreach( $services as $service )
                                            <option value="{{ $service->id }}"
                                                @if(in_array($service->id, $facilities))
                                                selected
                                                @endif
                                            >{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><b>{{ $errors->first('services') }}</b></span>
                                </div>

                                <div class="form-group">
                                    @php
                                        $fac = @$doctor->specialist;
                                        $facilities = explode(",",$fac);
                                    @endphp
                                    <label><strong>Specialist <span class="text-danger">*</span></strong></label>
                                    <select class="form-control select2 facilities_services" name="specialist[]" multiple>
                                        @foreach( $services as $service )
                                            <option value="{{ $service->id }}"
                                                @if(in_array($service->id, $facilities))
                                                selected
                                                @endif
                                            >{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><b>{{ $errors->first('specialist') }}</b></span>
                                </div>

                                <div class="form-group">
                                    <label><strong>Bio <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="bio" value="{{ isset($doctor->bio) ? $doctor->bio : old('address') }}" placeholder="Bio">
                                    <span class="text-danger"><b>{{ $errors->first('bio') }}</b></span>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <a href="{{ route('doctor.index') }}" class="btn btn btn-outline-danger">Cancel</a>
                                <button type="submit" class="btn btn btn-outline-success">
                                    @isset ($doctor)
                                        Update
                                    @endisset
                                    @empty ($doctor)
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
@section('scripts')
<script>
  jQuery(document).ready(function() {
      jQuery("input.daterange").daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY hh:mm A'
        }
      });
      jQuery("select.facilities_services").select2({
          placeholder: "Select Services"
      });
      jQuery("select.working_days").select2({
          placeholder: "Select Working Days"
      });
      jQuery("select.city").select2({
          placeholder: "Select City"
      });
  });
</script>
@endsection
