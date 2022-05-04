@include('partials/navigation')
<style>
section.thank-you-content {
    padding: 50px 0;
    width: 80%;
    margin: 0 auto;
}
.thankyou-wrapper{
  width:100%;
  height:auto;
  margin:auto;
  background:#ffffff;
  padding:10px 0px 50px;
}
.thankyou-wrapper h1{
  font:100px Arial, Helvetica, sans-serif;
  text-align:center;
  color:#333333;
  padding:0px 10px 10px;
}
.thankyou-wrapper p{
  font:26px Arial, Helvetica, sans-serif;
  text-align:center;
  color:#333333;
  padding:5px 10px 10px;
}
.bth-btn {
    font: 26px Arial, Helvetica, sans-serif;
    text-align: center;
    color: #ffffff;
    display: block;
    text-decoration: none;
    width: 250px;
    background: #a258ed;
    margin: 10px auto 0px;
    padding: 15px 20px 15px;
    border-bottom: 5px solid #8935df;
}
.bth-btn:hover {
    font: 26px Arial, Helvetica, sans-serif;
    text-align: center;
    color: #a258ed;
    display: block;
    text-decoration: none;
    width: 250px;
    background: #ffffff;
    margin: 10px auto 0px;
    padding: 15px 20px 15px;
    /* border-bottom: 5px solid #a258ed; */
    border: 1px solid #a258ed;
    border-bottom: 5px solid #a258ed;
}
</style>
<section class="thank-you-content">

    <section class="login-main-wrapper">
        <div class="main-container">
            <div class="login-process">
                <div class="login-main-container">
                    <div class="thankyou-wrapper">
                        <h1><img src="{{ asset('/images/thankyou.png') }}" alt="Thanks You" /></h1>
                          <p>for choosing us... </p>
                          <p>Your Order is in Processing Order ID: #{{ $key }}</p>
                          <p><a style="text-decoration: underline!important;" href="{{ route('dashboard') }}">View Order</a></p>
                          <a class="bth-btn" href="/">Back to home</a>
                          <div class="clr"></div>
                      </div>
                      <div class="clr"></div>
                  </div>
              </div>
              <div class="clr"></div>
          </div>
      </section>

</section>

@include('partials/footer')
