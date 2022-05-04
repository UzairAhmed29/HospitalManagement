<div class="footer_section layout_padding">
    <div class="container">
       <div class="footer_section_2">
          <div class="row">
             <div class="col-lg-3 col-sm-6">
                <h2 class="useful_text">Resources</h2>
                <div class="footer_menu">
                   <ul>
                      <li><a href="#">What we do</a></li>
                      <li><a href="#">Media</a></li>
                      <li><a href="#">Travel Advice</a></li>
                      <li><a href="#">Protection</a></li>
                      <li><a href="#">Care</a></li>
                   </ul>
                </div>
             </div>
             <div class="col-lg-3 col-sm-6">
                <h2 class="useful_text">About</h2>
                <p class="footer_text">Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various</p>
             </div>
             <div class="col-lg-3 col-sm-6">
                <h2 class="useful_text">Contact Us</h2>
                <div class="location_text">
                   <ul>
                      <li>
                         <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>
                         <span class="padding_15">Location</span></a>
                      </li>
                      <li>
                         <a href="#"><i class="fa fa-phone" aria-hidden="true"></i>
                         <span class="padding_15">Call +01 1234567890</span></a>
                      </li>
                      <li>
                         <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>
                         <span class="padding_15">demo@gmail.com</span></a>
                      </li>
                   </ul>
                </div>
             </div>
             <div class="col-lg-3 col-sm-6">
                <h2 class="useful_text">countrys</h2>
                <div class="map_image"><img src="images/map-bg.png"></div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!-- footer section end -->
 <!-- copyright section start -->
 <div class="copyright_section">
    <div class="container">
       <div class="row">
          <div class="col-sm-12">
             <p class="copyright_text">© 2022 All Rights Reserved.<a href=""></a></p>
          </div>
       </div>
    </div>
 </div>
 <!-- copyright section end -->
 <!-- Javascript files-->
 <script src="{{ asset('/js/jquery.min.js') }}"></script>
 <script src="{{ asset('/js/popper.min.js') }}"></script>
 <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('/js/jquery-3.0.0.min.js') }}"></script>
 <script src="{{ asset('/js/plugin.js') }}"></script>
 <!-- sidebar -->
 <script src="{{ asset('/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
 <!-- <script src="{{ asset('/js/custom.js') }}"></script> -->
 <!-- javascript -->
 <script src="{{ asset('/js/owl.carousel.js') }}"></script>
 <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
 <script>
    $(document).ready(function(){
    $(".fancybox").fancybox({
    openEffect: "none",
    closeEffect: "none"
    });

    $(".zoom").hover(function(){

    $(this).addClass('transition');
    }, function(){

    $(this).removeClass('transition');
    });
    });
 </script>
 <script>
    function openNav() {
    document.getElementById("myNav").style.width = "100%";
    }
    function closeNav() {
    document.getElementById("myNav").style.width = "0%";
    }
 </script>
 @yield('scripts')
</body>
</html>
