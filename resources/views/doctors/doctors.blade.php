@include('partials/navigation')
<style>
    section.doctor-section {
        background-image: url( '{{asset('/images/doctors.png')}}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        padding: 20% 0px;
    }
    section.doctor-content {
        padding: 50px 0;
        width: 80%;
        margin: 0 auto;
    }

    .product {
        margin-bottom: 30px;
    }
    .product-inner {
        box-shadow: 0 0 10px rgba(0,0,0,.2);
        padding: 10px;
    }
    .product img {
        margin-bottom: 10px;
    }
    .hospital-doctors {
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
    p.specialist {
        width: 260px;
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
    .call-now {
        padding: 10px 46px !important;
    }
    .cta-btn {
        background-color: #a258ed;
        color: white;
        padding: 10px 30px;
    }
    .cta-btn:hover {
        border: 1px solid #a258ed;
        color: #a258ed;
        background: white;
        padding: 10px 30px;
    }
    .doctor-details {
        width: 320px;
    }
    .call-to-actions p {
        margin: 20px 0;
    }
    input, select {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    input:focus, select:focus {
        border: 1px solid grey !important;
    }
    @media only screen and (max-width: 600px) {
        .container {display: flex;flex-direction: column;}

        div#hospital_doctors {flex-direction: column;}

        img.avatar-circle {height: 65px;}

        .call-to-actions {text-align: center;}

        p.specialist {width: 92%;}
    }
</style>
<section class="doctor-section"></section>
<section class="doctor-content">
    <h1 style="padding-bottom: 40px !important;">Doctors</h1>
    <div class="container" style="display: flex;">
        <div class="col-md-3">
            <div class="" id="search">
                <form id="search-form" action="{{ route('filter_doctor') }}" method="get">
                    <div class="form-group">
                        <input name="q" class="" type="text" placeholder="Search Doctor" value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}"/>
                    </div>
                    <div class="form-group">
                        <select data-filter="make" name="service" class="filter-make filter ">
                            <option value="">Select Service</option>
                            @foreach( $services as $service )
                                <option value="{{ $service->id }}"
                                    @if(isset($_GET['service']) && $_GET['service'] == $service->id)
                                        selected
                                    @endif
                                    >{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select data-filter="model" name="hospital" class="filter-model filter ">
                            <option value="">Select Hospital</option>
                            @foreach( $hospitals as $hospital )
                                <option value="{{ $hospital->id }}"
                                    @if(isset($_GET['hospital']) && $_GET['hospital'] == $hospital->id)
                                        selected
                                    @endif
                                >{{ $hospital->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select data-filter="type" name="city" class="filter-type filter ">
                            <option value="">Select City</option>
                            @foreach( $cities as $city )
                                <option value="{{ $city }}"
                                @if(isset($_GET['city']) && $_GET['city'] == $city)
                                selected
                            @endif
                                >{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select data-filter="day" name="day" class="filter-price filter ">
                            <option value="">Select Day</option>
                            <option value="Mon" {{ isset($_GET['day']) && $_GET['day'] == "Mon" ? 'selected' : '' }}>Monday</option>
                            <option value="Tue" {{ isset($_GET['day']) && $_GET['day'] == "Tue" ? 'selected' : '' }}>Tuesday</option>
                            <option value="Wed" {{ isset($_GET['day']) && $_GET['day'] == "Wed" ? 'selected' : '' }}>Wednesday</option>
                            <option value="Thu" {{ isset($_GET['day']) && $_GET['day'] == "Thu" ? 'selected' : '' }}>Thursday</option>
                            <option value="Fri" {{ isset($_GET['day']) && $_GET['day'] == "Fri" ? 'selected' : '' }}>Friday</option>
                            <option value="Sat" {{ isset($_GET['day']) && $_GET['day'] == "Sat" ? 'selected' : '' }}>Saturday</option>
                            <option value="Sun" {{ isset($_GET['day']) && $_GET['day'] == "Sun" ? 'selected' : '' }}>Sunday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Search</button>
                        <button type="reset" class="btn btn-block btn-primary">Reset Filters</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            <div class="" id="doctors">
                <div class="hospital-doctors" id="doctors">
                    @forelse( $doctors as $doctor )
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
                    @empty
                    <p>No Doctors Found according to your search.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials/footer')
