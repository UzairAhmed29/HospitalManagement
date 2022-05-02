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
                <form action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}" method="POST" name="UserCreateUpdate" enctype="multipart/form-data">
                    @csrf
                    @isset ($user)
                        @method('PUT')
                    @endisset
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Name <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="name" value="{{ isset($user->name) ? $user->name : old('name') }}" placeholder="Name">
                                    <span class="text-danger"><b>{{ $errors->first('name') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>Password <span class="text-danger">*</span></strong></label>
                                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password">
                                    <span class="text-danger"><b>{{ $errors->first('password') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label>Avatar</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="avatar" class="custom-file-input" id="inputGroupFile01" value="">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Email <span class="text-danger">*</span></strong></label>
                                    <input type="email" class="form-control" name="email" value="{{ isset($user->email) ? $user->email : old('email') }}" placeholder="Email">
                                    <span class="text-danger"><b>{{ $errors->first('email') }}</b></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>Role <span class="text-danger">*</span></strong></label>
                                    <select name="role" class="form-control">
                                        <option value="admin" {{ (old('role') == 'admin') ? 'selected' : '' }}
                                            @if(isset($user->role) && $user->role == 'admin')
                                                selected
                                            @endif
                                            >Administrator</option>
                                            <option value="vendor"  {{ (old('role') == 'vendor') ? 'selected' : '' }}
                                            @if(isset($user->role) && $user->role == 'vendor')
                                                selected
                                            @endif
                                            >Vendor</option>
                                            <option value="customer"  {{ (old('role') == 'customer') ? 'selected' : '' }}
                                            @if(isset($user->role) && $user->role == 'customer')
                                                selected
                                            @endif
                                            >Customer</option>
                                    </select>
                                    <span class="text-danger"><b>{{ $errors->first('role') }}</b></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <a href="{{ route('user.index') }}" class="btn btn btn-outline-danger">Cancel</a>
                                <button type="submit" class="btn btn btn-outline-success">
                                    @isset ($user)
                                        Update
                                    @endisset
                                    @empty ($user)
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
