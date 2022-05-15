@include('partials/navigation')
@php
    if( isset($hospital->picture) && !empty($hospital->picture) ) {
        $picture = asset('/public/uploads/hospital/'.$hospital->picture);
    } else {
        $picture = asset('/images/hospital.png');
    }
@endphp
<style>
section.hospital-section {
        background-image: url( '{{ $picture }}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        padding: 20% 0px;
    }
    section.hospital-content {
        padding: 50px 0;
        width: 80%;
        margin: 0 auto;
    }
    .card-title p {
        margin: 8px 0!important;
    }
    .hospital-register {
        background: white;
        padding: 10px 26px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
    }
    .hospital-register p {
        font-size: 16px;
        font-family: 'Poppins';
        font-weight: 400;
    }
    .hospital-register a {
        background-color: #a258ed;
        color: white;
        padding: 10px;
    }
    .hospital-register a:hover {
        border: 1px solid #a258ed;
        color: #a258ed;
        background: white;
    }
    i {
        color: #a258ed;
        font-size: 22px;
        margin-right: 4px;
    }
    .row-col {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .call-now {
        padding: 10px 46px !important;
    }
    .call-now, .get-dir, .cta-btn {
        background-color: #a258ed;
        color: white;
        padding: 10px 30px;
    }
    .get-dir:hover, .call-now:hover, .cta-btn:hover {
        border: 1px solid #a258ed;
        color: #a258ed;
        background: white;
        padding: 10px 30px;
    }
    .items {
        display: flex;
        margin: 20px 0px;
        border: 1px solid #a258ed;
        padding: 20px;
        align-items: center;
    }
    .item {
        margin-right: 30px;
    }
    .items .item a:hover:after {
        color: #a258ed;
        content: '';
        display: block;
        width: 100%;
        height: 2px;
        background: #a258ed;
        transition: width .3s;
    }
    .items .item a.active {
        color: #a258ed;
    }
    div#general-info p {
        margin: 7px 0px !important;
        color: #6e6e83;
    }
    div#general-info {
        margin-bottom: 30px;
    }
    div#hospital_doctors {
        box-shadow: rgb(0 0 0 / 10%) 0px 4px 12px;
        padding: 20px;
        display: flex;
        justify-content: space-between;
    }
    .avatar-circle {
        border-radius: 130px;
        margin-right: 20px;
        height: 85%;
    }
    p.specialist span {
        background: #bdb9b9;
        color: white;
        padding: 2px 10px;
        border-radius: 50px;
        font-size: 13px;
    }
    p.specialist, .lives-in, .exp, .education {
        margin: 0 !important;
    }
    p.lives-in {
        font-weight: 500;
        margin-top: 10px !important;
    }
    .hospital-doctors {
        margin-bottom: 30px;
    }
    p.specialist {
        width: 260px;
    }
    @media only screen and (max-width: 600px) {
        .hospital-detail {width: 65%;}

        .row-col {align-items: center;}

        .hospital-loc-phone p {margin: 10px 0 20px 0 !important;}

        a.call-now {padding: 10px 24px !important;}

        a.get-dir {padding: 10px 8px !important;}

        li.item { margin-right: 14px;}

        div#general-info {text-align: center;}

        div#hospital_doctors {flex-direction: column;}

        img.avatar-circle {height: 65px;}

        .call-to-actions {text-align: center;}

        p.specialist {width: 100%;}

        div#facilities {margin-top: 20px;text-align: center;}

        #facilities p.specialist {width: 100%;}
    }
</style>
<section class="hospital-section"></section>
<section class="hospital-content">
    <div class="hospital-register">
        <p>Register as a Hospital Vendor</p>
        <a href="{{ route('vendor_register_view') }}">Register Now</a>
    </div>
    <div class="row-col">
        <div class="hospital-detail">
            <h1 style="font-size: 34px;">{{ $hospital->name }}</h1>
            <ul>
                <li class="hos-map">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span>{{ $hospital->address }} </span>
                </li>
                @if( isset($hospital->total_doctors) )
                <li class="hos-map">
                    <i class="fa fa-stethoscope" aria-hidden="true"></i>
                    <span>{{ $hospital->total_doctors }} Doctors</span>
                </li>
                @endif
            </ul>
        </div>
        <div class="hospital-loc-phone">
            <p><a href="tel:+{{ $hospital->phone }}" class="call-now">Call Now</a></p>
            <p><a target="_blank" href="http://maps.google.com/maps?q={{ $hospital->address }}" class="get-dir">Get Direction</a></p>
        </div>
    </div>
    <div class="hospital-info-detail">
        <nav id="secondary_nav" class="" style="">
            <div class="container">
                <ul class="clearfix items">
                    <li class="item"><a href="#general-info" class="active">Overview</a></li>
                    <li class="item"><a href="#doctors" class="">Doctors</a></li>
                    <li class="item"><a href="#facilities" class="">Facility & Services</a></li>
                </ul>
            </div>
        </nav>
        <div class="hospital-general-info" id="general-info">
            <h2>Overview</h2>

            @if( isset($hospital->consultation_fee) )
                <p><strong>Consultation Fee </strong>Rs. {{ $hospital->consultation_fee }}</p>
            @endif

            @if( isset($hospital->total_doctors) )
                <p><strong>Total No. Of Doctors: </strong>{{ $hospital->total_doctors }}</p>
            @endif

            <p><strong>No. Of beds: </strong>{{ $hospital->no_of_beds }}</p>
            <p><strong>No. Of Ventilators: </strong>{{ $hospital->no_of_vents }}</p>
            <p><strong>Active Corona Cases: </strong>{{ $hospital->active_cases }}</p>
            <p><strong>Recovered: </strong>{{ $hospital->recovered_patients }}</p>
            <p><strong>Deaths: </strong>{{ $hospital->deaths }}</p>
        </div>
        @if(isset($doctors))
        <div class="hospital-doctors" id="doctors">
            <h2>Doctors</h2>
            @foreach( $doctors as $doctor )
            @php
                if( isset($doctor->picture) ):
                    $picture = asset("/public/uploads/doctor/".$doctor->picture);
                else :
                    $picture = asset("/images/non-doctor.png");
                endif;
            @endphp
            <section class="hospital-filter-card">
                <div class="hospital-detail-pro-card-wrap" id="hospital_doctors">
                <div style="display: flex;">
                    <img class="avatar-circle" src="{{ $picture }}" alt="{{ $doctor->name }}">
                    <div class="doctor-details">
                        <h2>{{ $doctor->name }}</h2>
                        @php
                            $spec = explode(",", $doctor->specialist);
                        @endphp
                        <p class="specialist">
                            @foreach($spec as $s)
                            @php

                                $j = \App\Models\Services::find($s);
                            @endphp
                                <span>{{ @$j->name }}</span>
                            @endforeach
                        </p>
                        <p class="lives-in">{{ $doctor->city }}</p>
                        <p class="exp"><strong>Expirience: </strong>{{ $doctor->expirience }}</p>
                        <p class="education">{{ $doctor->education }}</p>
                    </div>
                </div>

                    <div class="call-to-actions">
                        <p><a class="cta-btn" href="{{ route('doctor_app_view', $doctor->slug) }}">Book Appointment</a></p>
                        <p><a class="cta-btn" style="padding: 10px 57px;" href="{{ route('doctor_details', $doctor->slug) }}">View Profile</a></p>
                    </div>
                </div>
            </section>
            @endforeach
        </div>
        @endif

        <div class="hospital-facilities" id="facilities">
            <h2>Facilities & Services</h2>
            <p class="specialist">
                <span>Orthipedic</span>
                <span>Physician</span>
                <span>Pharmacology</span>
            </p>
        </div>
    </div>
</section>
@include('partials/footer')

