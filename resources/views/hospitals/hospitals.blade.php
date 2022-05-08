@include('partials/navigation')
<style>
section.hospital-section {
        background-image: url( '{{asset('/images/hospital.png')}}');
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
    .card.mb-2.bg-gradient-dark {
        min-height: 210px;
        border: none !important;
    }
    img.card-img-top {
        min-height: 200px !important;
    }
</style>
<section class="hospital-section"></section>
<section class="hospital-content">
    <div class="hospital-register">
        <p>Register as a Hospital Vendor</p>
        <a href="{{ route('vendor_register_view') }}">Register Now</a>
    </div>
    <h1>Hospitals</h1>
    <div class="card-body">
        <div class="row">
            @forelse( $hospitals as $hospital )
            @php
                if( isset($hospital->picture) && !empty($hospital->picture) ) {
                    $image = asset('/public/uploads/hospital/'.$hospital->picture);
                } else {
                    $image = asset('/images/non-hospital.png');
                }
            @endphp
            <div class="col-md-12 col-lg-6 col-xl-4">
                <div class="card mb-2 bg-gradient-dark"> <img class="card-img-top" src="{{ $image }}" alt="{{ $hospital->name }}">
                </div>
                <h5 class="card-title" style="font-size: 20px; color: black!important;">
                    <a href="{{ route('hospital_details', $hospital->slug) }}">{{ $hospital->name }}</a>
                    <p class="" style=""><strong>Address:</strong> {{ $hospital->address }}</p>
                    <p class="" style=""><strong>Phone:</strong> {{ $hospital->phone }}</p>
                </h5>

            </div>
            @empty
            <p>Hospitals Not Found!</p>
            @endforelse()
        </div>
    </div>
</section>

@include('partials/footer')
