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
                <form action="{{ isset($hospital) ? route('vendor_hospital_update') : route('vendor_hospital_create') }}" method="POST" name="VendorHospitalUpdate" enctype="multipart/form-data">
                    @csrf
                    @isset($hospital)
                        @method('PUT')
                    @endisset
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Hospital Name <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="name" value="{{ isset($hospital->name) ? $hospital->name : old('name') }}" placeholder="Hospital Name">
                                    <span class="text-danger"><b>{{ $errors->first('name') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>Address <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="address" value="{{ isset($hospital->address) ? $hospital->address : old('address') }}" placeholder="Address">
                                    <span class="text-danger"><b>{{ $errors->first('address') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>Phone <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="phone" value="{{ isset($hospital->phone) ? $hospital->phone : old('address') }}" placeholder="Phone">
                                    <span class="text-danger"><b>{{ $errors->first('phone') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>No. of Beds <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="no_of_beds" value="{{ isset($hospital->no_of_beds) ? $hospital->no_of_beds : old('no_of_beds') }}" placeholder="No. of Beds">
                                    <span class="text-danger"><b>{{ $errors->first('no_of_beds') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>Total Corona Deaths <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="deaths" value="{{ isset($hospital->deaths) ? $hospital->deaths : old('address') }}" placeholder="Total Corona Deaths">
                                    <span class="text-danger"><b>{{ $errors->first('deaths') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>Consultation Fee </strong></label>
                                    <input type="text" class="form-control" name="consultation_fee" value="{{ isset($hospital->consultation_fee) ? $hospital->consultation_fee : old('consultation_fee') }}" placeholder="Consultation Fee">
                                    <span class="text-danger"><b>{{ $errors->first('consultation_fee') }}</b></span>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                <div class="form-group">
                                    @php
                                        $fac = @$hospital->facilities_services;
                                        $facilities = explode(",",$fac);
                                    @endphp
                                    <label><strong>Facilities & Services <span class="text-danger">*</span></strong></label>
                                    <select class="form-control select2 facilities_services" name="facilities_services[]" multiple>
                                        @foreach( $services as $service )
                                            <option value="{{ $service->id }}"
                                                @if(in_array($service->id, $facilities))
                                                selected
                                                @endif
                                            >{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><b>{{ $errors->first('facilities_services') }}</b></span>
                                </div>

                                <div class="form-group">
                                    <label><strong>Total No. Of Doctors</strong></label>
                                    <input type="text" class="form-control" name="total_doctors" value="{{ isset($hospital->total_doctors) ? $hospital->total_doctors : old('address') }}" placeholder="Total No. Of Doctors">
                                    <span class="text-danger"><b>{{ $errors->first('total_doctors') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>No. of Ventilators <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="no_of_vents" value="{{ isset($hospital->no_of_vents) ? $hospital->no_of_vents : old('no_of_vents') }}" placeholder="No. of Ventilators">
                                    <span class="text-danger"><b>{{ $errors->first('no_of_vents') }}</b></span>
                                </div>

                                <div class="form-group">
                                    <label><strong>Active Corona Cases <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="active_cases" value="{{ isset($hospital->active_cases) ? $hospital->active_cases : old('address') }}" placeholder="Active Corona Cases">
                                    <span class="text-danger"><b>{{ $errors->first('active_cases') }}</b></span>
                                </div>

                                <div class="form-group">
                                    <label><strong>Recovered Corona Patients <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="recovered_patients" value="{{ isset($hospital->recovered_patients) ? $hospital->recovered_patients : old('address') }}" placeholder="Recovered Corona Patients">
                                    <span class="text-danger"><b>{{ $errors->first('recovered_patients') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="picture" value="{{ ($hospital) ? $hospital->picture : null }}">
                                    <label>Hospital Picture</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="picture" class="custom-file-input" id="inputGroupFile01" value="">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <a href="{{ route('hospital.index') }}" class="btn btn btn-outline-danger">Cancel</a>
                                <button type="submit" class="btn btn btn-outline-success">
                                    @isset($hospital)
                                        Update
                                    @endisset
                                    @empty($hospital)
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
      jQuery("select.facilities_services").select2({
          placeholder: "Select Facilities & Services"
      });
  });
</script>
@endsection
