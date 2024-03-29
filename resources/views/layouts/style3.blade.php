
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-111105160-3', 'auto');
        ga('send', 'pageview');
    </script>

    <title>Satelite - Creative Showcase Portfolio Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Download the best Creative Portfolio HTML Template in 2018" />
    <meta name="author" content="ClaPat Studio">
    <meta charset="UTF-8" />
    <link rel="icon" type="image/ico" href="favicon.ico" />
    <link href="{{asset('css/style2.css')}}" rel="stylesheet" />
    <link href="{{asset('css/portfolio.css')}}" rel="stylesheet" />
    <link href="{{asset('css/showcase.css')}}" rel="stylesheet" />
    <link href="{{asset('css/shortcodes.css')}}" rel="stylesheet" />
    <link href="{{asset('css/assets.css')}}" rel="stylesheet" />
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,700" rel="stylesheet">

</head>







<body class="hidden hidden-ball smooth-scroll">

<main>
    <!-- Preloader -->
    <div class="preloader-wrap">
        <div class="outer">
            <div class="inner">
                <div class="percentage" id="precent"></div>
                <div class="trackbar">
                    <div class="loadbar"></div>
                </div>
                <div class="headphones"></div>
                <div class="headphones-text">Turn up the volume for the<br>best experience</div>
            </div>
        </div>
    </div>
    <!--/Preloader -->

    <div class="cd-index cd-main-content">

        <!-- Page Content -->
        <div id="page-content" class="light-content">

            <!-- Header -->
            <header class="classic-menu">
                <div id="header-container">


                    <!-- Logo -->
                    <div id="logo" class="hide-ball">
                        <a class="ajax-link" data-type="page-transition" href="index.html">
                            <img class="black-logo" src="{{asset('images/logo.png')}}" alt="ClaPat Logo">
                            <img class="white-logo" src="{{asset('images/logo-white.png')}}" alt="ClaPat Logo">
                        </a>
                    </div>
                    <!--/Logo -->

                    <!-- Navigation -->
                    <nav>
                        <div class="nav-height">
                            <div class="outer">
                                <div class="inner">
                                    <ul data-breakpoint="1025" class="flexnav">
                                        <li class="link menu-timeline"><a href="#"><span data-hover="Works">Works</span></a>
                                            <ul>
                                                <li><a class="ajax-link active" href="index.html" data-type="page-transition">Fullscreen Slider</a></li>
                                                <li><a class="ajax-link" href="carousel.html" data-type="page-transition">Small Carousel</a></li>
                                                <li><a class="ajax-link" href="large-carousel.html" data-type="page-transition">Large Carousel</a></li>
                                                <li><a class="ajax-link" href="portfolio.html" data-type="page-transition">Classic Portfolio</a></li>
                                                <li><a class="ajax-link" href="index-full.html" data-type="page-transition">Fullscreen Menu</a></li>
                                            </ul>
                                        </li>
                                        <li class="link menu-timeline"><a class="ajax-link" data-type="page-transition" href="about.html"><span data-hover="About">About</span></a></li>
                                        <li class="link menu-timeline"><a class="ajax-link" data-type="page-transition" href="contact.html"><span data-hover="Contact">Contact</span></a></li>
                                        <li class="link menu-timeline buy-item"><a target="_blank" href="https://themeforest.net/item/satelite-creative-ajax-portfolio-showcase-slider-template/23155838"><span data-hover="Buy Now">Buy Now</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <!--/Navigation -->

                    <!-- Menu Burger -->
                    <div id="burger-wrapper" class="parallax-wrap">
                        <div id="menu-burger" class="parallax-element">
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!--/Menu Burger -->

                </div>
            </header>
            <!--/Header -->

            <!-- Content Scroll -->
            <div id="content-scroll">
            </div>
            <!--/Content Scroll -->

            <!-- Main -->
            <div id="main">
                <!-- Main Content -->
                <div id="main-content">



                    <!-- Showcase Holder -->
                    <div id="showcase-holder">
                        <div id="showcase-tilt-wrap">
                            <div id="showcase-tilt">
                                <div id="showcase-slider" class="swiper-container">
                                    <div class="swiper-wrapper">


                                        <!-- Section Slide -->
                                        <div class="swiper-slide" data-title="THE QUEEN" data-subtitle="Photography" data-number="01">
                                            <div class="img-mask">
                                                <div class="section-image" data-src="images/01hero.jpg"></div>
                                            </div>
                                            <a class="showcase-link-project" data-type="page-transition" href="project01.html"></a>
                                        </div>
                                        <!--/Section Slide -->


                                        <!-- Section Slide -->
                                        <div class="swiper-slide" data-title="DARK PATH" data-subtitle="Photography" data-number="02">
                                            <div class="img-mask">
                                                <div class="section-image" data-src="images/02hero.jpg"></div>
                                            </div>
                                            <a class="showcase-link-project" data-type="page-transition" href="project02.html"></a>
                                        </div>
                                        <!--/Section Slide -->


                                        <!-- Section Slide -->
                                        <div class="swiper-slide bg-video" data-title="ELIE SAAB" data-subtitle="Video" data-number="03">
                                            <div class="img-mask">
                                                <div class="section-image" data-src="images/03hero.jpg">
                                                    <div class="hero-video-wrapper">
                                                        <video loop muted class="bgvid">
                                                            <source src="{{asset('video/ELIE_SAAB_40s_LOOP-preview.mp4')}}" type="video/mp4">
                                                            <source src="{{asset('video/ELIE_SAAB_40s_LOOP-preview.webm')}}" type="video/webm">
                                                        </video>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="showcase-link-project" data-type="page-transition" href="project03.html"></a>
                                        </div>
                                        <!--/Section Slide -->


                                        <!-- Section Slide -->
                                        <div class="swiper-slide" data-title="LADY IN RED" data-subtitle="Design" data-number="04">
                                            <div class="img-mask">
                                                <div class="section-image" data-src="images/04hero.jpg"></div>
                                            </div>
                                            <a class="showcase-link-project" data-type="page-transition" href="project04.html"></a>
                                        </div>
                                        <!--/Section Slide -->


                                        <!-- Section Slide -->
                                        <div class="swiper-slide" data-title="INFO BUGS" data-subtitle="Design" data-number="05">
                                            <div class="img-mask">
                                                <div class="section-image" data-src="images/05hero.jpg"></div>
                                            </div>
                                            <a class="showcase-link-project" data-type="page-transition" href="project05.html"></a>
                                        </div>
                                        <!--/Section Slide -->


                                        <!-- Section Slide -->
                                        <div class="swiper-slide" data-title="NEON DUDE" data-subtitle="Photography" data-number="06">
                                            <div class="img-mask">
                                                <div class="section-image" data-src="images/06hero.jpg"></div>
                                            </div>
                                            <a class="showcase-link-project" data-type="page-transition" href="project06.html"></a>
                                        </div>
                                        <!--/Section Slide -->


                                        <!-- Section Slide -->
                                        <div class="swiper-slide" data-title="SPORT BLACK" data-subtitle="Design" data-number="07">
                                            <div class="img-mask">
                                                <div class="section-image" data-src="images/07hero.jpg"></div>
                                            </div>
                                            <a class="showcase-link-project" data-type="page-transition" href="project07.html"></a>
                                        </div>
                                        <!--/Section Slide -->


                                        <!-- Section Slide -->
                                        <div class="swiper-slide" data-title="WILD HORSE" data-subtitle="Photography" data-number="08">
                                            <div class="img-mask">
                                                <div class="section-image" data-src="images/08hero.jpg"></div>
                                            </div>
                                            <a class="showcase-link-project" data-type="page-transition" href="project08.html"></a>
                                        </div>
                                        <!--/Section Slide -->


                                        <!-- Section Slide -->
                                        <div class="swiper-slide" data-title="FOREST HOUSE" data-subtitle="Architecture" data-number="09">
                                            <div class="img-mask">
                                                <div class="section-image" data-src="images/09hero.jpg"></div>
                                            </div>
                                            <a class="showcase-link-project" data-type="page-transition" href="project09.html"></a>
                                        </div>
                                        <!--/Section Slide -->


                                        <!-- Section Slide -->
                                        <div class="swiper-slide" data-title="THUNDER STRIKE" data-subtitle="Photography" data-number="10">
                                            <div class="img-mask">
                                                <div class="section-image" data-src="images/10hero.jpg"></div>
                                            </div>
                                            <a class="showcase-link-project" data-type="page-transition" href="project10.html"></a>
                                        </div>
                                        <!--/Section Slide -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="showcase-pagination-wrap">
                            <div class="showcase-counter" data-total="10"></div>
                            <div class="showcase-pagination"></div>
                            <div class="caption-border left"></div>
                            <div class="caption-border right"></div>
                            <div class="arrows-wrap">
                                <div class="prev-wrap parallax-wrap"><div class="swiper-button-prev swiper-button-white parallax-element"></div></div>
                                <div class="next-wrap parallax-wrap"><div class="swiper-button-next swiper-button-white parallax-element"></div></div>
                            </div>
                        </div>
                    </div>
                    <!-- Showcase Holder -->


                </div>
                <!--/Main Content -->
            </div>
            <!--/Main -->





            <!-- Footer -->
            <footer class="fixed">
                <div id="footer-container">

                    <div class="button-wrap left">
                        <div class="icon-wrap parallax-wrap">
                            <div class="button-icon parallax-element">
                                <div class="bars">
                                    <div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-text"><span data-on="Sound On" data-off="Sound Off">Sound On</span></div>
                    </div>

                    <div class="footer-button-wrap parallax-wrap hide-ball">
                        <div class="footer-button parallax-element">
                            <div class="button-border rounded outline parallax-element-second"><span data-hover="Click and Hold">View Case</span></div>
                        </div>
                    </div>

                    <div class="socials-wrap">
                        <div class="socials-icon"><i class="fa fa-share-alt" aria-hidden="true"></i></div>
                        <div class="socials-text">Follow us</div>
                        <ul class="socials">
                            <li><span class="parallax-wrap"><a class="parallax-element" href="https://www.dribbble.com/clapat" target="_blank">Db</a></span></li>
                            <li><span class="parallax-wrap"><a class="parallax-element" href="https://www.twitter.com/clapatdesign" target="_blank">Tw</a></span></li>
                            <li><span class="parallax-wrap"><a class="parallax-element" href="https://www.behance.com/clapat" target="_blank">Be</a></span></li>
                            <li><span class="parallax-wrap"><a class="parallax-element" href="https://www.facebook.com/clapat.ro" target="_blank">Fb</a></span></li>
                            <li><span class="parallax-wrap"><a class="parallax-element" href="https://www.instagram.com/clapat.themes/">In</a></span></li>
                        </ul>
                    </div>

                </div>
            </footer>
            <!--/Footer -->



        </div>
        <!--/Page Content -->

    </div>
</main>




<div class="cd-cover-layer"></div>
<div id="magic-cursor">
    <div id="ball">
        <div id="hold-event"></div>
        <div id="ball-loader"></div>
    </div>
</div>
<div id="clone-image"></div>
<div id="rotate-device"></div>



<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/ScrollMagic.min.js')}}"></script>
<script src="{{asset('js/debug.addIndicators.min.js')}}"></script>
<script src="{{asset('js/animation.gsap.min.js')}}" ></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpK1sWi3J3EbUOkF_K4-UHzi285HyFX5M&sensor=false"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/scripts2.js')}}"></script>



</body>

</html>
