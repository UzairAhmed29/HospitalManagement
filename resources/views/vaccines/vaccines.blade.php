@include('partials/navigation')
<style>
section.hospital-section {
        background-image: url( '{{asset('/images/vaccines.png')}}');
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

    .sq_box {
        padding-bottom: 5px;
        border-bottom: solid 2px #a258ed;
        background-color: #fff;
        text-align: center;
        padding: 15px 10px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .sq_box h4 {
        font-size: 18px;
        text-align: center;
        font-weight: 500;
        color: #343a40;
        margin-top: 10px;
        margin-bottom: 10px !important;
    }
    .sq_box .price-box {
        margin-bottom: 15px !important;
    }
    .sq_box .btn {
        border-radius: 50px;
        padding: 5px 13px;
        font-size: 15px;
        color: #fff;
        background-color: #a258ed;
        font-weight: 600;
    }
    .sq_box .price-box span.price {
        text-decoration: line-through;
        color: #6c757d;
    }
    .sq_box span {
        font-size: 14px;
        font-weight: 600;
        margin: 0px 10px;
    }
    .sq_box .price-box span.offer-price {
        color:#28a745;
    }
    .sq_box img {
        object-fit: cover;
        height: 150px !important;
        margin-top: 20px;
    }
    .item {
        width: 30%;
    }
    .card-body {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

</style>
<section class="hospital-section"></section>
<section class="hospital-content">
    <h1>Vaccines</h1>
    <div class="card-body">
        @forelse( $vaccines as $vaccine )
            @php
                if( isset($vaccine->picture) ):
                    $picture = asset("/public/uploads/vaccine/".$vaccine->picture);
                else :
                    $picture = asset("/images/non-vaccine.png");
                endif;
            @endphp
            <div class="item">
                <div class="sq_box shadow">
                    <div class="pdis_img">
                        <a href="{{ route('vaccine_detail', $vaccine->slug) }}">
                        <img src="{{ $picture }}">
                        </a>
                    </div>
                    <h4 class="mb-1">
                        <a href="{{ route('vaccine_detail', $vaccine->slug) }}"> {{ $vaccine->name }} </a>
                        <p style="margin: 0;text-align: center;">Hospital: {{ $vaccine->hospital->name }} </p>
                        </h4>
                    <div class="price-box mb-2">
                        <span class="offer-price">Price: Rs. {{ $vaccine->price }} </span>
                    </div>
                    <div class="btn-box text-center">
                        <a class="btn btn-sm" href="{{ route('add_to_cart', $vaccine->slug) }}">
                        <i class="fa fa-shopping-cart"></i> Add to Cart </a>
                    </div>
                </div>
            </div>
                @empty
                <p>No Vaccines Found</p>
                @endforelse
        </div>
</section>

@include('partials/footer')
