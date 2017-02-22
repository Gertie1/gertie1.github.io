
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pharma Advisory System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- google fonts -->

    <!-- Css link -->
    {!! Html::style('../resources/assets/assets/css/ionicons.min.css') !!}
    {!! Html::style('../resources/assets/assets/css/font-awesome.min.css') !!}
    {!! Html::style('../resources/assets/assets/css/owl.carousel.css') !!}
    {!! Html::style('../resources/assets/assets/owl.transitions.css') !!}
    {!! Html::style('../resources/assets/assets/css/animate.min.css') !!}
    {!! Html::style('../resources/assets/assets/css/lightbox.css') !!}
    {!! Html::style('../resources/assets/assets/css/bootstrap-home.min.css') !!}
    {!! Html::style('../resources/assets/assets/css/preloader.css') !!}
    {!! Html::style('../resources/assets/assets/css/image.css') !!}
    {!! Html::style('../resources/assets/assets/css/icon.css') !!}
    {!! Html::style('../resources/assets/assets/css/style-home.css') !!}
    {!! Html::style('../resources/assets/assets/css/responsive.css') !!}


</head>
<body id="top">


<header id="navigation" class="navbar-fixed-top animated-header">
    <div class="container">
        <div class="navbar-header">
            <!-- responsive nav button -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- /responsive nav button -->

            <!-- logo -->
        {{-- <h1 class="navbar-brand">
             <a href="#body"><img src="img/logo.png" height="40" width="164" alt=""></a>
         </h1>--}}
        <!-- /logo -->
        </div>

        <!-- main nav -->
        <nav class="collapse navbar-collapse navbar-right" role="navigation">
            <ul id="nav" class="nav navbar-nav menu">
                <li><a href="#top">Home</a></li>
                {{--<li><a href="#features">Service</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#blog">Latest Listings</a></li>
                <li><a href="#testimonial">User Comments</a></li>
                <li><a href="#contact-form">Contact</a></li>--}}
            </ul>
        </nav>
        <!-- /main nav -->

    </div>
</header>


<div class="wrapper">
    <section id="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <h1>Pharma Advisory System</h1>
                        <h2><br> <i></i></h2>
                        <div class="buttons">
                            <a href="{!! URL::route('register') !!}" class="btn btn-learn">Register Now</a>
                            <a href="{!! URL::route('login') !!}" class="btn btn-learn">Log In</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scrolldown">
            <a id="scroll" href="#features" class="scroll"></a>
        </div>
    </section>
    <section id="features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>THE SYSTEM SERVICES</h2>
                        <p>The services offered by the system are: <br></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-xs-6 col-sm-6">
                    <div class="feature-block text-center">
                        <div class="icon-box">
                            <i class="ion-easel"></i>
                        </div>
                        <h4 class="wow fadeInUp" data-wow-delay=".3s">Registration</h4>
                        <p class="wow fadeInUp" data-wow-delay=".5s">Pharmacists can register<br>to enjoy the services</p>
                    </div>
                </div>
                <div class="col-md-4 col-xs-6 col-sm-6">
                    <div class="feature-block text-center">
                        <div class="icon-box">
                            <i class="ion-paintbucket"></i>
                        </div>
                        <h4 class="wow fadeInUp" data-wow-delay=".3s">Prediction</h4>
                        <p class="wow fadeInUp" data-wow-delay=".5s">Predicts supply based on disease prevalence <br> The system then uses Regression Analysis <br> To calculate the value of commodity consumption</p>
                    </div>
                </div>
                <div class="col-md-4 col-xs-6 col-sm-6">
                    <div class="feature-block text-center">
                        <div class="icon-box">
                            <i class="ion-paintbrush"></i>
                        </div>
                        <h4 class="wow fadeInUp" data-wow-delay=".3s">Inventory Management</h4>
                        <p class="wow fadeInUp" data-wow-delay=".5s">Manages inventories of commodities<br>.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="counter">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>FACTS</h2>
                    <p>This system has been developed as partial <br>fulfillment for a Bachelor of Science degree <br>in Computer Science</p>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="block wow fadeInRight" data-wow-delay=".3s">
                        <i class="ion-code"></i>
                        <p class="count-text">
                            <span class="counter-digit"> Laravel </span> k
                        </p>
                        <p>Framework</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="block wow fadeInRight" data-wow-delay=".5s">
                        <i class="ion-compass"></i>
                        <p class="count-text">
                            <span class="counter-digit">Machine Learning </span>
                        </p>
                        <p>Regression</p>
                    </div>
                </div>
                {{--  <div class="col-md-3 col-sm-6 col-xs-6">
                      <div class="block wow fadeInRight" data-wow-delay=".7s">
                          <i class="ion-compose"></i>
                          <p class="count-text">
                              <span class="counter-digit">Cryptography</span>
                          </p>
                          <p>Digital Signatures</p>
                      </div>
                  </div>--}}
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="block wow fadeInRight" data-wow-delay=".9s">
                        <i class="ion-image"></i>
                        <p class="count-text">
                            <span class="counter-digit">9995</span>
                        </p>
                        <p>Lines Coded</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--    <section id="portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <h2 class="wow fadeInUp" data-wow-delay=".3s">JOIN US TODAY</h2>
                            <p class="wow fadeInUp" data-wow-delay=".5s">Join Us and experience modern day farming</p>
                            <a href="login" class="html5lightbox" data-width=800 data-height=400>
                                <div class="button ion-ios-play-outline wow zoomIn" data-wow-delay=".3s"></div>
                            </a>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>--}}

    {{--   <section id="client-logo">
           <div class="container">
               <div class="row">
                   <div class="col-md-12">
                       <div class="block">
                           <div id="Client_Logo" class="owl-carousel">
                               <div>
                                   <a href="#"><img class="img-responsive" src="img/clientLogo/client-logo1.jpg" alt=""></a>
                               </div>
                               <div>
                                   <a href="#"><img class="img-responsive" src="img/clientLogo/client-logo2.jpg" alt=""></a>
                               </div>
                               <div>
                                   <a href="#"><img class="img-responsive" src="img/clientLogo/client-logo3.jpg" alt=""></a>
                               </div>
                               <div>
                                   <a href="#"><img class="img-responsive" src="img/clientLogo/client-logo4.jpg" alt=""></a>
                               </div>
                               <div>
                                   <a href="#"><img class="img-responsive" src="img/clientLogo/client-logo5.jpg" alt=""></a>
                               </div>
                               <div>
                                   <a href="#"><img class="img-responsive" src="img/clientLogo/client-logo6.jpg" alt=""></a>
                               </div>
                               <div>
                                   <a href="#"><img class="img-responsive" src="img/clientLogo/client-logo1.jpg" alt=""></a>
                               </div>
                               <div>
                                   <a href="#"><img class="img-responsive" src="img/clientLogo/client-logo2.jpg" alt=""></a>
                               </div>
                               <div>
                                   <a href="#"><img class="img-responsive" src="img/clientLogo/client-logo3.jpg" alt=""></a>
                               </div>
                               <div>
                                   <a href="#"><img class="img-responsive" src="img/clientLogo/client-logo4.jpg" alt=""></a>
                               </div>
                               <div>
                                   <a href="#"><img class="img-responsive" src="img/clientLogo/client-logo5.jpg" alt=""></a>
                               </div>
                               <div>
                                   <a href="#"><img class="img-responsive" src="img/clientLogo/client-logo6.jpg" alt=""></a>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>--}}

    {{--    <section id="blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <h2>Latest Listings</h2>
                            <p>Here are some of the latest and hotest <br> farm listings in the system</p>
                        </div>
                        <div id="blog-post" class="owl-carousel">
                            <div>
                                <div class="block">
                                    <img src="img/blog/blog-1.jpg" alt="" class="img-responsive">
                                    <div class="content">
                                        <h4><a href="blog.html">Hey,This is a blog title</a></h4>
                                        <small>By admin / Sept 18, 2014</small>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex itaque repudiandae nihil qui debitis atque necessitatibus aliquam, consequuntur autem!
                                        </p>
                                        <a href="blog.html" class="btn btn-read">Read More</a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="block">
                                    <img src="img/blog/blog-2.jpg" alt="" class="img-responsive">
                                    <div class="content">
                                        <h4><a href="blog.html">Hey,This is a blog title</a></h4>
                                        <small>By admin / Sept 18, 2014</small>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex itaque repudiandae nihil qui debitis atque necessitatibus aliquam, consequuntur autem!
                                        </p>
                                        <a href="blog.html" class="btn btn-read">Read More</a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="block">
                                    <img src="img/blog/blog-3.jpg" alt="" class="img-responsive">
                                    <div class="content">
                                        <h4><a href="blog.html">Hey,This is a blog title</a></h4>
                                        <small>By admin / Sept 18, 2014</small>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex itaque repudiandae nihil qui debitis atque necessitatibus aliquam, consequuntur autem!
                                        </p>
                                        <a href="blog.html" class="btn btn-read">Read More</a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="block">
                                    <img src="img/blog/blog-4.jpg" alt="" class="img-responsive">
                                    <div class="content">
                                        <h4><a href="blog.html">Hey,This is a blog title</a></h4>
                                        <small>By admin / Sept 18, 2014</small>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex itaque repudiandae nihil qui debitis atque necessitatibus aliquam, consequuntur autem!
                                        </p>
                                        <a href="blog.html" class="btn btn-read">Read More</a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="block">
                                    <img src="img/blog/blog-1.jpg" alt="" class="img-responsive">
                                    <div class="content">
                                        <h4><a href="blog.html">Hey,This is a blog title</a></h4>
                                        <small>By admin / Sept 18, 2014</small>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex itaque repudiandae nihil qui debitis atque necessitatibus aliquam, consequuntur autem!
                                        </p>
                                        <a href="blog.html" class="btn btn-read">Read More</a>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>--}}




    {{--   <section id="testimonial">
           <div class="container">
               <div class="row">
                   <div class="title">
                       <h2>TESTIMONIAL</h2>
                       <p>Dantes remained confused and silent by this explanation of the <br> thoughts which had unconsciously</p>
                   </div>
                   <div class="col col-md-6">
                       <div class="media wow fadeInLeft" data-wow-delay=".3s">
                           <div class="media-left">
                               <a href="#">
                                   <img src="img/service-img.png" alt="">
                               </a>
                           </div>
                           <div class="media-body">
                               <a href="#"><h4 class="media-heading">Jonathon Andrew</h4></a>
                               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commo</p>
                           </div>
                       </div>
                   </div>
                   <div class="col col-md-6">
                       <div class="media wow fadeInRight" data-wow-delay=".3s">
                           <div class="media-left">
                               <a href="#">
                                   <img src="img/service-img.png" alt="">
                               </a>
                           </div>
                           <div class="media-body">
                               <a href="#"><h4 class="media-heading">Jonathon Andrew</h4></a>
                               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commo</p>
                           </div>
                       </div>
                   </div>
                   <div class="col col-md-6">
                       <div class="media wow fadeInLeft" data-wow-delay=".3s">
                           <div class="media-left">
                               <a href="#">
                                   <img src="img/service-img.png" alt="">
                               </a>
                           </div>
                           <div class="media-body">
                               <a href="#"><h4 class="media-heading">Jonathon Andrew</h4></a>
                               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commo</p>
                           </div>
                       </div>
                   </div>
                   <div class="col col-md-6">
                       <div class="media wow fadeInRight" data-wow-delay=".3s">
                           <div class="media-left">
                               <a href="#">
                                   <img src="img/service-img.png" alt="">
                               </a>
                           </div>
                           <div class="media-body">
                               <a href="#"><h4 class="media-heading">Jonathon Andrew</h4></a>
                               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commo</p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>--}}

    <section id="contact-form">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>CONTACT US</h2>
                    <p>Get back to us by filling<br> out the form</p>
                </div>
                <div class="col-md-6 col">
                    <!-- map -->
                    <div class="map">
                        <div id="googleMap"></div>
                    </div><!--/map-->

                </div>
                <div class="col-md-6">
                    <form>
                        <input type="text" class="form-control" placeholder="Name">
                        <input type="text" class="form-control" placeholder="Email">
                        <textarea class="form-control" rows="3" placeholder="Message"></textarea>
                        <button class="btn btn-default" type="submit">SEND</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <a href="#"><img src="img/logo.png" alt=""></a>
                        <p>All rights reserved © 2016</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- load Js -->
{!! Html::script('../resources/assets/assets/js/jquery-1.11.3.min.js') !!}
{!! Html::script('../resources/assets/assets/js/bootstrap.min.js') !!}
{!! Html::script('../resources/assets/assets/js/waypoints.min.js') !!}
{!! Html::script('../resources/assets/assets/js/lightbox.js') !!}
{!! Html::script('../resources/assets/assets/js/jquery.counterup.min.js') !!}
{!! Html::script('../resources/assets/assets/js/owl.carousel.min.js') !!}
{!! Html::script('../resources/assets/assets/js/html5lightbox.js') !!}
{!! Html::script('../resources/assets/assets/js/jquery.mixitup.js') !!}
{!! Html::script('../resources/assets/assets/js/wow.min.js') !!}
{!! Html::script('../resources/assets/assets/js/jquery.scrollUp.js') !!}
{!! Html::script('../resources/assets/assets/js/jquery.sticky.js') !!}
{!! Html::script('../resources/assets/assets/js/jquery.nav.js') !!}
{!! Html::script('../resources/assets/assets/js/main.js') !!}


</body>
</html>