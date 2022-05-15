@include('partials/navigation')
<style>
    .doctor-main {
        margin: 0 auto;
        width: 80%;
        padding-top: 50px;
    }
    .avatar-circle {
        border-radius: 130px;
        margin-right: 20px;
        height: 50%;
    }
    p.margin-non span, .service {
        background: #bdb9b9;
        color: white;
        padding: 2px 10px;
        border-radius: 50px;
        font-size: 13px;
    }
    p.margin-non {
        margin: 5px !important;
    }
    .content {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
    }
    .detail {
        display: flex;
    }
    i {
        color: #a258ed;
        font-size: 22px;
        margin-right: 4px;
    }
    .book-app p {
        margin: 10px 0;
    }
    .book-hospital-app {
        height: 280px;
    }
    .book-hospital-app p {
        margin: 10px 20px;
        width: 370px;
    }
    .app-box-header {
        background: #a258ed;
        color: white;
        text-align: center;
        padding: 10px 100px;
        margin: 0 !important;
    }
    .book-app {
        border: 1px solid #d7d1d1;
        border-radius: 3px;
        box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
        height: 370px;
    }
    .book-app-btn {
        background-color: #a258ed;
        color: white;
        padding: 10px 30px;
    }
    .book-app-btn:hover {
        border: 1px solid #a258ed;
        color: #a258ed;
        background: white;
        padding: 10px 30px;
    }
    .meta-detail p {
        margin: 10px 0px !important;
    }
    @media only screen and (max-width: 600px) {
        .content {flex-direction: column;}

        .detail {flex-direction: column;}

        .detail div {text-align: center;}

        .book-app {margin-top: 20px;}

        p.app-box-header {padding: 10px 40px;}

        .book-hospital-app p {width: 90%;}

        .meta-detail p:last-child {width: 100% !important;}

    }
</style>
<section class="doctor-main">
    <div class="content">
        <div class="detail">
            <div>
                @php
                    if( isset($doctor->picture) ):
                        $picture = asset("/public/uploads/doctor/".$doctor->picture);
                    else :
                        $picture = asset("/images/non-doctor.png");
                    endif;
                @endphp
                <img class="avatar-circle" src="{{ $picture }}" alt="{{ $doctor->name }}">
            </div>
            <div>
                <h2>{{ $doctor->name }}</h2>
                <p class="margin-non">
                    @php
                        $spec = explode(",", $doctor->specialist);
                    @endphp
                    @foreach($spec as $s)
                    @php
                        $j = \App\Models\Services::find($s);
                    @endphp
                        <span>{{ @$j->name }}</span>
                        @endforeach
                </p>
                <p class="margin-non">{{ $doctor->city }}</p>
                <p class="margin-non">{{ $doctor->education }}</p>
                <p class="margin-non">Expirience: {{ $doctor->expirience }} Years</p>
            </div>
        </div>



        <div class="book-app">
            <p class="app-box-header">Book an appointment</p>
            <div class="book-hospital-app">
                @if( isset($doctor->hospital) && !empty($doctor->hospital) )
                    <p><i class="fa fa-hospital-o" aria-hidden="true"></i>{{ $doctor->hospital->name }}</p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i>{{ $doctor->hospital->address }}</p>
                    <p><i class="fa fa-money" aria-hidden="true"></i>{{ $doctor->fee }}</p>
                    <hr />
                    <p style="text-align: center; font-weight: 600;">Phone Number</p>
                    <p style="text-align: center; font-weight: 600; font-size: 20px !important;"><i  style="font-size: 30px;" class="fa fa-phone" aria-hidden="true"></i>{{ $doctor->hospital->phone }}</p>
                    <p style="text-align: center; margin-top: 30px;"><a class="book-app-btn" href="tel:+{{$doctor->hospital->phone}}">Call to Book an Appointment</a></p>
                @endif
            </div>
        </div>
    </div>

    <div class="meta-detail">
        <h2>More Information<h2>
        <p></strong></strong>{{ $doctor->bio }}</p>
        <p><strong>Timming:</strong> {{ $doctor->timming }}</p>
        <p></strong>Working Days: </strong>{{ $doctor->working_days }}</p>
        <p></strong>Consultation Fee: </strong>{{ $doctor->fee }}</p>
        <p style="width: 60%;"><strong>Services: </strong>
        @php
            $spec = explode(",", $doctor->services);
            @endphp
            @foreach($spec as $s)
            @php
                $j = \App\Models\Services::find($s);
            @endphp
                <span class="service">{{ @$j->name }}</span>
            @endforeach
        </p>
    </div>

</section>

@include('partials/footer')
