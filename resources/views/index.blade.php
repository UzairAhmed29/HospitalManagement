@include('partials/header')
<style>
    div#maincounter-wrap h1 {
        font-size: 30px;
    }
    .cases {
        width: 80%;
        margin: 40px auto;
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding-top: 55px;
        margin-bottom: 5%;
    }
    #maincounter-wrap {
        margin-top:15px;
    }
    .maincounter-number {
        text-align: center;
    }
    .maincounter-number span {
        color:#aaaaaa;
        font-size: 30px;
    }
    .cases-hospitals {
        width: 80%;
        margin: 40px auto;
    }
    .hospital-register {
        background: white;
        padding: 10px 26px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
        width: 80%;
        margin: 0 auto;
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
    @media only screen and (max-width: 600px) {
        .cases {
            flex-direction: column;
        }
        .hospital-register a {
            font-size: 12px;
            padding: 1px 13px !important;
            text-align: center;
        }
        .footer_section.layout_padding {
            text-align: center;
        }
    }
</style>
      <!--header section start -->
      <div class="header_section">
        @include('partials/menu-bar')
      </div>
      <!-- header section end -->
      <!-- protect section start -->
        <div class="cases">
            <div class="group-cases">
                <div id="maincounter-wrap">
                    <h1>Coronavirus Cases:</h1>
                    <div class="maincounter-number">
                        <span>{{ number_format($a, 0, ',', ',') }} </span>
                    </div>
                </div>
            </div>
            <div class="group-cases">
                <div id="maincounter-wrap">
                    <h1>Recovered:</h1>
                    <div class="maincounter-number">
                        <span>{{ number_format($r, 0, ',', ',') }}  </span>
                    </div>
                </div>
            </div>
            <div class="group-cases">
                <div id="maincounter-wrap">
                    <h1>Deaths:</h1>
                    <div class="maincounter-number">
                        <span>{{ number_format($d, 0, ',', ',') }} </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="cases-hospitals">
            <h2>Cases in Hospitals of Pakistan</h2>
            <table class="table table-hover table-heatmap" data-sortable="" data-sortable-initialized="true">
                <thead>
                    <tr>
                        <th style="cursor: pointer">Hospital</th>
                        <th data-sortable="true" data-heatmap="0" data-heatmap-limit="176" style="cursor: pointer">Active </th>
                        <th data-sortable="true" style="cursor: pointer">Recovered </th>
                        <th class="hidden-xs" style="cursor: pointer">Deaths</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hospitals as $hospital)
                    <tr class="datatable-row">
                        <td style="max-width: 120px; overflow: hidden; padding-left: 10px; text-align: left; font-weight: 600;"> {{ $hospital->name }}</a></td>
                        <td data-heatmap-value="176"> {{ $hospital->active_cases }}</td>
                        <td> {{ $hospital->recovered_patients }}</td>
                        <td class="hidden-xs"><span> {{ $hospital->deaths }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="hospital-register">
            <p>Register as a Hospital Vendor</p>
            <a href="{{ route('vendor_register_view') }}">Register Now</a>
        </div>

      <div class="protect_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <h1 class="protect_taital">How to Protect Yourself</h1>
                  <p class="protect_text">English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for</p>
               </div>
            </div>
            <div class="protect_section_2 layout_padding">
               <div class="row">
                  <div class="col-md-6">
                     <h1 class="hands_text"><a href="#">Wash your <br>hands frequently</a></h1>
                     <h1 class="hands_text_2"><a href="#">Maintain social <br>distancing</a></h1>
                     <h1 class="hands_text"><a href="#">Avoid touching eyes,<br>nose and mouth</a></h1>
                  </div>
                  <div class="col-md-6">
                     <div class="image_2"><img src="images/img-2.png"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- protect section end -->
      <!-- about section start -->
      <div class="about_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="about_img"><img src="images/img-1.png"></div>
               </div>
               <div class="col-md-6">
                  <h1 class="about_taital">Coronavirus what it is?</span></h1>
                  <p class="about_text">when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using</p>
                  <div class="read_bt"><a href="#">Read More</a></div>
               </div>
            </div>
         </div>
      </div>
      <!-- about section end -->
      <!-- doctor section start -->
      <div class="doctors_section layout_padding">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="taital_main">
                     <div class="taital_left">
                        <div class="play_icon"><img src="images/play-icon.png"></div>
                     </div>
                     <div class="taital_right">
                        <h1 class="doctor_taital">What doctors say..</h1>
                        <p class="doctor_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look</p>
                        <div class="readmore_bt"><a href="#">Read More</a></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- doctor section end -->
      <!-- news section start -->
      <div class="news_section layout_padding">
         <div class="container">
            <div id="main_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <h1 class="news_taital">Latest News</h1>
                     <p class="news_text">when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using</p>
                     <div class="news_section_2 layout_padding">
                        <div class="box_main">
                           <div class="image_1"><img src="images/news-img.png"></div>
                           <h2 class="design_text">Coronavirus is Very dangerous</h2>
                           <p class="lorem_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look</p>
                           <div class="read_btn"><a href="#">Read More</a></div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                    <h1 class="news_taital">Latest News</h1>
                     <p class="news_text">when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using</p>
                     <div class="news_section_2 layout_padding">
                        <div class="box_main">
                           <div class="image_1"><img src="images/news-img.png"></div>
                           <h2 class="design_text">Coronavirus is Very dangerous</h2>
                           <p class="lorem_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look</p>
                           <div class="read_btn"><a href="#">Read More</a></div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                    <h1 class="news_taital">Latest News</h1>
                     <p class="news_text">when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using</p>
                     <div class="news_section_2 layout_padding">
                        <div class="box_main">
                           <div class="image_1"><img src="images/news-img.png"></div>
                           <h2 class="design_text">Coronavirus is Very dangerous</h2>
                           <p class="lorem_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look</p>
                           <div class="read_btn"><a href="#">Read More</a></div>
                        </div>
                     </div>
                  </div>
               </div>
               <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
               <i class="fa fa-angle-left"></i>
               </a>
               <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
               <i class="fa fa-angle-right"></i>
               </a>
            </div>
            </div>
         </div>
      </div>
      <!-- news section end -->
      <!-- update section start -->
      <div class="update_section">
         <div class="container">
            <h1 class="update_taital">Get Every Update.... </h1>
            <form action="/action_page.php">
               <div class="form-group">
                   <textarea class="update_mail" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
               </div>
               <div class="subscribe_bt"><a href="#">Subscribe Now</a></div>
            </form>
         </div>
      </div>
      <!-- update section end -->
      <!-- footer section start -->
@include('partials/footer');
