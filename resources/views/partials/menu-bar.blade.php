<div class="container-fluid">
    <div class="main">
        <div class="logo"><a href="{{ route('index') }}"><img width="200" src="{{ asset('/images/logo.png') }}"></a></div>
        <div class="menu_text">
            <ul>
            <div class="togle_">
                <div class="menu_main">
                    <ul>
                        <li><a href="{{ route('hospitals') }}">Hospitals</a></li>
                        {{-- <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li> --}}
                    </ul>
                </div>
            </div>
            <div id="myNav" class="overlay">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <div class="overlay-content">
                    <a href="{{ route('index') }}">Home</a>
                    <a href="protect.html">Protect</a>
                    <a href="about.html">About</a>
                    <a href="doctors.html">Doctors</a>
                    <a href="news.html">News</a>
                </div>
            </div>
            <span class="navbar-toggler-icon"></span>
            <span onclick="openNav()"><img src="images/toogle-icon.png" class="toggle_menu"></span>
            <span onclick="openNav()"><img src="images/toogle-icon1.png" class="toggle_menu_1"></span>
            </ul>
        </div>
    </div>
</div>

<div class="banner_section layout_padding">
    <div class="container">
       <div id="my_slider" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
             <div class="carousel-item active">
                <div class="row">
                   <div class="col-md-6">
                      <div class="container">
                         <h1 class="banner_taital">Get Medical Care early</h1>
                         <p class="banner_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                         <div class="more_bt"><a href="#">Read More</a></div>
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="banner_img"><img src="images/banner-img.png"></div>
                   </div>
                </div>
             </div>
             <div class="carousel-item">
                <div class="row">
                   <div class="col-md-6">
                      <div class="container">
                         <h1 class="banner_taital">Get Medical Care early</h1>
                         <p class="banner_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                         <div class="more_bt"><a href="#">Read More</a></div>
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="banner_img"><img src="images/banner-img.png"></div>
                   </div>
                </div>
             </div>
             <div class="carousel-item">
                <div class="row">
                   <div class="col-md-6">
                      <div class="container">
                         <h1 class="banner_taital">Get Medical Care early</h1>
                         <p class="banner_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                         <div class="more_bt"><a href="#">Read More</a></div>
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="banner_img"><img src="images/banner-img.png"></div>
                   </div>
                </div>
             </div>
          </div>
          <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
          <i class="fa fa-angle-left"></i>
          </a>
          <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
          <i class="fa fa-angle-right"></i>
          </a>
       </div>
    </div>
 </div>
