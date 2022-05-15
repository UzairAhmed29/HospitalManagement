@include('partials/header')
<style>
    .header {
        display: flex;
        width: 100%;
        justify-content: space-between;
        padding: 15px 40px;
        align-items: center;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
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
            display: block;
        }
        .header a img {
            margin-left: 150px;
        }
        .header-right {
            float: none;
            width: 50% !important;
            margin: 0 auto;
        }
        .hospital-register a {
            text-align: center;
            padding: 6px 8px;
            line-height: 20px;
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
    @media only screen and (max-width: 600px) {
        .header-right {
            width: 100%;
        }
        .header-right a {
            font-size: 15px;
            margin: 0 5px;
            padding: 0;
        }
    }
</style>
<div class="logo"></div>
<div class="header">
    <a href="{{ route('index') }}"><img width="200" src="{{ asset('/images/logo.png') }}"></a>
    <div class="header-right">
      <a class="active" href="/">Home</a>
      <a href="{{ route('doctors') }}">Doctors</a>
      <a href="{{ route('hospitals') }}">Hospitals</a>
      <a href="{{ route('vaccines') }}">Vaccines</a>
      @if(!Auth::guest())
        <a href="{{ route('dashboard') }}">Account</a>
      @endif
    </div>
</div>
