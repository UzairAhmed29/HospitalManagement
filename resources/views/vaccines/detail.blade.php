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
        margin: 50px auto;
    }

.card-wrapper{
    margin: 0 auto;
}
.product-content{
    padding: 2rem 1rem;
}
.product-title{
    font-size: 3rem;
    text-transform: capitalize;
    font-weight: 700;
    position: relative;
    color: #12263a;
    margin: 1rem 0;
}
.product-title::after{
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    height: 4px;
    width: 80px;
    background: #12263a;
}
.product-link{
    text-decoration: none;
    text-transform: uppercase;
    font-weight: 400;
    font-size: 0.9rem;
    display: inline-block;
    margin-bottom: 0.5rem;
    background: #256eff;
    color: #fff;
    padding: 0 0.3rem;
    transition: all 0.5s ease;
}
.product-link:hover{
    opacity: 0.9;
}
.product-price{
    margin: 1rem 0;
    font-size: 1rem;
    font-weight: 700;
}
.product-price span{
    font-weight: 400;
}
.new-price span{
    color: #256eff;
}
.product-detail h2{
    text-transform: capitalize;
    color: #12263a;
    padding-bottom: 0.6rem;
}
.product-detail p{
    font-size: 0.9rem;
    padding: 0.3rem;
    opacity: 0.8;
}
.product-detail ul{
    margin: 1rem 0;
    font-size: 0.9rem;
}
.product-detail ul li{
    margin: 0;
    list-style: none;
    background: url(https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/checked.png) left center no-repeat;
    background-size: 18px;
    padding-left: 1.7rem;
    margin: 0.4rem 0;
    font-weight: 600;
    opacity: 0.9;
}
.product-detail ul li span{
    font-weight: 400;
}
.purchase-info{
    margin: 1.5rem 0;
}
.purchase-info input,
.purchase-info .btn{
    border: 1.5px solid #ddd;
    border-radius: 25px;
    text-align: center;
    padding: 0.45rem 0.8rem;
    outline: 0;
    margin-right: 0.2rem;
    margin-bottom: 1rem;
}
.purchase-info input{
    width: 60px;
}
.purchase-info .btn{
    cursor: pointer;
    color: #fff;
}
.purchase-info .btn:first-of-type{
    background: #a258ed;
}
.purchase-info .btn:hover{
    opacity: 0.9;
}
.margin-non {
    margin: 0 !important;
}
button.btn a {
    color: white;
}
@media screen and (min-width: 992px){
    .card{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 1.5rem;
    }
    .card-wrapper{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .product-imgs{
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .product-content{
        padding-top: 0;
    }
}


</style>
<section class="hospital-section"></section>
<section class="hospital-content">

    <div class="card-wrapper">
        <div style="display: flex">
          <div class="product-imgs">
            <div class="img-select">
                @php
                    if( isset($vaccine->picture) ):
                        $picture = asset("/public/uploads/vaccine/".$vaccine->picture);
                    else :
                        $picture = asset("/images/non-vaccine.png");
                    endif;
                @endphp
                <img src="{{ $picture }}">
            </div>
          </div>
          <div class="product-content">
            <h2 class="product-title">{{ $vaccine->name }}</h2>
            <div class="product-price">
              <p class="margin-non new-price"> Price: <span>Rs. {{ $vaccine->price }}</span></p>
            </div>
            <div class="product-detail">
              <ul>
                <li>Doses: <span>{{ $vaccine->doses }}</span></li>
                <li>Effectiveness: <span>{{ $vaccine->effective }}</span></li>
                <li>In Stock: <span>Yes</span></li>
                @if( isset($vaccine->hospital) && !empty($vaccine->hospital) )
                    <li>Hospital: <span>{{ $vaccine->hospital->name }}</span></li>
                    <li>Hospital Address: <span>{{ $vaccine->hospital->address }}</span></li>
                    <li>Hospital Contact: <span>{{ $vaccine->hospital->phone }}</span></li>
                @endif
              </ul>
            </div>
            <div class="purchase-info">
              <button type="button" class="btn">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <a href="{{ route('add_to_cart', $vaccine->slug) }}">Add to Cart
            </button>
            </div>
          </div>
        </div>
      </div>

</section>

@include('partials/footer')
