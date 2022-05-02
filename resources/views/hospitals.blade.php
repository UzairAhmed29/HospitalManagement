@include('partials/header')
<style>
    .header {
        display: flex;
        width: 100%;
        justify-content: space-between;
        padding: 15px 40px;
        align-items: center;
    }

    .header a {
        color: black;
        text-align: center;
        text-decoration: none;
        font-size: 18px;
        line-height: 25px;
        border-radius: 4px;
    }

    .header a.main-logo {
      font-size: 25px;
      font-weight: bold;
    }

    .header a:hover {
      color: black;
    }

    .header a.active {
      background-color: #a258ed;
      color: white;
    }

    .header-right {
      float: right;
    }

    .header-right a {
        padding: 5px 20px;
    }


    @media screen and (max-width: 500px) {
        .header a {
            float: none;
            display: block;
            text-align: left;
        }

        .header-right {
            float: none;
        }
        a.main-logo {
            margin-bottom: 20px;
        }
        .header {
            display: block;
        }
        .header-right a {
            text-align: center;
        }
        a.main-logo {
            text-align: center;
        }
    }
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
    </style>
<div class="logo"></div>
<div class="header">
    <a href="{{ route('index') }}"><img width="200" src="{{ asset('/images/logo.png') }}"></a>
    <div class="header-right">
      <a class="active" href="#home">Home</a>
      <a href="#contact">Doctors</a>
      <a href="#about">Vaccines</a>
    </div>
</div>
<section class="hospital-section"></section>
<section class="hospital-content">
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
                <div class="card mb-2 bg-gradient-dark"> <img class="card-img-top" style="max-height: 200px !important;" src="{{ $image }}" alt="{{ $hospital->name }}">
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
