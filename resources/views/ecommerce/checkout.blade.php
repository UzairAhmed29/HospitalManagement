@include('partials/navigation')
<style>
section.checkout {
    padding: 50px 0;
    width: 80%;
    margin: 50px auto;
}
input[type="text"], input[type="password"], select, input[type="email"], input[type="tel"], input[type="date"], textarea
{
	border: 1px solid #ddd;
	background-color: #fff;
	color: #959595;
	width: 100%;
	padding: 10px;
	font-size: 12px;
	margin: 7px 0 25px 0;
}

label
{
	font-size: 14px;
}

select
{
	height: 37px;
}

input[type="checkbox"]
{
	margin: 5px 10px 5px 0px;
}

.user-pswd input[type="checkbox"]
{
	margin: 5px 10px 5px 15px;
}

input[type="checkbox"] + p, input[type="radio"] + p
{
	font-size: 15px;
	padding: 0 5px;
	display: inline;
	color: #959595;
}

input[type="radio"] + p
{
	font-size: 13px;
	padding: 0 0 0 20px;
}

input[type="submit"]
{
	padding: 10px 20px;
	color: #fff;
	background-color: #000;
	text-transform: uppercase;
	border: none;
	cursor: pointer;
}

input[type="submit"]:hover
{
	background-color: #a258ed;
	border: none;
}

.order .redbutton
{
	background-color: #a258ed;
	padding: 13px 30px;
	font-size: 18px;
	font-weight: 600;
	margin-top: 25px;
}

.order .redbutton:hover
{
	background-color: #000;
	border: none;
}

.wrapper
{
	width: 100%;
	margin: 0 auto;
	margin-bottom: 100px;
}

.row:before, .row:after
{
	content: " ";
	display: table;
}

.row:after
{
	clear: both;
}

.col
{
	margin-right: 16px;
	float: left;
}

.col:last-child
{
	margin-right: 0;
}

.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12
{
	width: 100%;
}

/* TABLET STARTS HERE */

@media(min-width: 768px) {
	.wrapper {
		width: 768px;
	}
	.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11 {
		width: 376px;
	}
	.col-12 {
		width: 100%;
	}
	.col:nth-child(2n+2) {
		margin-right: 0;
	}

}
/*DESKTOP STARTS HERE*/
@media(min-width: 1136px) {
	.wrapper{width: 1136px;}
	.col-5{width: 464px;}
	.col-7{width: 656px;}
	.col-12{width: 100%;}
    .col:nth-child(2n+2){margin-right: 16px}
    .col:last-child{margin-right: 0;}
}
body {
	font-family: 'Poppins', sans-serif;
	color: #959595;
}

h1 {
	font-size: 72px;
    padding: 20px 0;
    text-transform: uppercase;
	color: #000;
}
 h3.topborder {
    margin-top: 0;
}
h3.topborder:before {
   	content: "";
   	display: block;
   	border-top: 1px solid #c2c2c2;
   	width: 100%;
   	height: 1px;
   	position: absolute;
    top: 50%;
    z-index: 1;
}
h3.topborder span {
    background: #fff;
    padding: 0 10px 0 0;
    position: relative;
    z-index: 5;
}
header {
	height: 250px;
	background-image: url('http://lorempixel.com/1920/500');
	background-size: cover;
	text-align: center;
	line-height: 210px;
}
.fa-info {
	font-size: 24px;
	padding: 0 20px;
	color: #757575;
	line-height: 56px;
	vertical-align: middle;
}

.info-bar {
	height: 56px;
	background-color: #f5f5f5;
	margin: 20px 0;
}

.info-bar p:first-child {
	padding: 0;
}
.order {
	border: 12px solid #f5f5f5;
	padding: 30px;
	margin-top: 28px;
}
.order div:not(.qty) {
	width: 100%;
	border-bottom: 1px solid #DDDDDD;
	padding: 20px 0;
}
.order p {
	padding: 0;
	line-height: 20px;
}
.order h4, h5 {
	padding: 0;
}
.order div:nth-child(6) {
	border: none;
}
.padleft {
	margin-left: 39px;
}
.inline {
	display: inline-block;
}
.alignright {
	float: right;
}
.paymenttypes {
	border: 1px solid #DDDDDD;
	width: 135px;
	padding: 0 8px;
	margin: 0 0 20px 10px;
	display: inline-block;
	vertical-align: middle;
}
.paypal {
	width: 39px;
	height: 13px;
}
.order {
	line-height: 40px;
	color: #000;
}
fieldset.bank-details p {
    margin: 0 !important;
    margin-left: 40px !important;
    color: grey;
    font-size: 14px;
}
</style>
<section class="checkout-content">

    <header>
        <h1>Checkout</h1>
</header>
    <div class="wrapper">
        <div class="row">
            <div class="col-12 col">
                <div class="info-bar">
                    <p>
                        <i class="fa fa-info"></i>
                        Returning customer? <a href="{{ route('login') }}">Click here to login</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <form method="post" name="checkout" action="{{ route('checkout_process') }}">
                @csrf
                <div class="col-7 col">
                    <h3 class="topborder"><span>Details</span></h3>

                    <div class="">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name">
                        <span class="text-danger"><b>{{ $errors->first('name') }}</b></span>
                    </div>

                    <div class="">
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email">
                        <span class="text-danger"><b>{{ $errors->first('email') }}</b></span>
                    </div>

                    <div class="">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password">
                        <span class="text-danger"><b>{{ $errors->first('password') }}</b></span>
                    </div>

                    <div class="">
                        <label for="phone">Phone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" id="tel">
                        <span class="text-danger"><b>{{ $errors->first('phone') }}</b></span>
                    </div>

                    <div class="">
                        <label for="address">Address <span class="text-danger">*</span></label>
                        <input type="text" name="address" id="address">
                        <span class="text-danger"><b>{{ $errors->first('address') }}</b></span>
                    </div>

                    <div class="">
                        <label for="nic">NIC Number <span class="text-danger">*</span></label>
                        <input type="text" name="nic" id="nic">
                        <span class="text-danger"><b>{{ $errors->first('nic') }}</b></span>
                    </div>

                    <div class="">
                        <label for="nic">Date  <span class="text-danger">*</span></label>
                        <input type="date" name="date" id="date">
                        <span class="text-danger"><b>{{ $errors->first('date') }}</b></span>
                    </div>

                    <div class="">
                        <p style="margin:0 5px;"><strong>Dose <span class="text-danger">*</span></strong></p>
                        <div>
                            <input type="radio" name="dose" id="dose" value="1" checked>
                            <label>First</label>
                        </div>
                        <div>
                            <input type="radio" name="dose" id="dose" value="2">
                            <label>Second</label>
                        </div>
                        <span class="text-danger"><b>{{ $errors->first('radio') }}</b></span>
                    </div>

                </div>
                @php
                    $cart = \Cart::getContent();
                @endphp
                <div class="col-5 col order">
                    <h3 class="topborder"><span>Your Order</span></h3>
                    <div class="row">
                        <h4 class="inline alignright">Order Details</h4>
                    </div>
                    <div>
                        @foreach( Cart::getContent() as $item )
                            <p style="margin:0 !important;">Vaccine: {{ $item->name }}
                            @if(isset($item->attributes->hospital['name']))
                                <p style="margin:0 !important;">Hospital: {{ $item->attributes->hospital['name'] }}</p>
                            @endif
                        @endforeach
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between;"><span><h5>Order Total</h5></span><span>Rs: {{ Cart::getTotal() }} </span></div>

                    <div>
                        <h3 class="topborder"><span>Payment Method</span></h3>
                        <input type="radio" value="banktransfer" name="payment" checked><p>Direct Bank Transfer</p>
                        <p class="padleft">
                            Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.
                        </p>
                        <fieldset class="bank-details">
                            <p>Bank: Standard Chartered Pakistan</p>
                            <p>Bank Account Number: 85588786</p>
                            <p>Routing Number: 21085949</p>
                            <p>IBAN: PK70358555672043330195249696</p>
                        </fieldset>
                    </div>
                    <div>
                        <input type="radio" value="cod" name="payment"><p>Cash on Delivery</p>
                    </div>
                    <hr>
                    {{-- <div>
                        <input type="radio" value="stripe" name="payment"><p>Stripe</p>
                    </div> --}}
                    <input type="submit" name="submit" class="redbutton" value="Place Order">
                </div>
            </form>
        </div>
    </div>

</section>

@include('partials/footer')
