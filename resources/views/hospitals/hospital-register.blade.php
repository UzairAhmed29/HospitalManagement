@include('partials/navigation')
<style>
    .hospital-registration {
        width: 80%;
        margin: 0 auto;
        text-align: center;
        margin-top: 60px;
    }
    .form-group {
        text-align: left;
    }
    .vendor-register-btn {
        background-color: #a258ed;
        color: white;
        padding: 10px 30px;
    }
    .form-control:focus {
        border-color: #ced4da !important;
    }
</style>
<section class="hospital-registration content">
    <h1 style="font-size: 34px;">Register as a Hospital Vendor</h1>
        <div class="container-fluid">
            <div class="card-body">
                <div class="row" style="justify-content:center;">
                    <div class="col-md-3"></div>
                    <div class="col-md-6" style="padding: 20px 40px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
                        <form name="vendorRegister" action="{{ route('vendor_register') }}" method="POST">
                            @csrf

                            @if(Session::has('success'))
                                <p class="text-success">
                                    {{ Session::get('success') }}
                                </p>
                                @endif

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
                                <span class="text-danger"><b>{{ $errors->first('name') }}</b></span>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" type="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                                <span class="text-danger"><b>{{ $errors->first('email') }}</b></span>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" id="password" type="password" name="password" placeholder="Password" autocomplete="new-password">
                                <span class="text-danger"><b>{{ $errors->first('password') }}</b></span>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password">
                                <span class="text-danger"><b>{{ $errors->first('password_confirmation') }}</b></span>
                            </div>
                            <div style="display: flex; justify-content: space-around; align-items: center;">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}"> Already registered? </a>
                                <button type="submit" class="vendor-register-btn">Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
</section>

@include('partials/footer')
