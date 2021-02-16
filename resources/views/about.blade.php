@extends('layouts.app')

@section('page_title', 'About ' . config('app.name'))

@section('content')

<div class="breadcrumb-area">
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-3 pt-100 pb-95 page_banner">
        <div class="container">
            <h2>About Us</h2>
            <p>NIIT is Africa’s largest information technology Education provider. </p>
        </div>
    </div>
    <div class="breadcrumb-bottom">
        <div class="container">
            <ul>
                <li><a href="{{ route('homepage') }}">Home</a> <span><i class="fa fa-angle-double-right"></i> About Us</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="choose-area bg-img pt-90" style="background-imagezzz:url(assets/img/bg/bg-8.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="about-chose-us pt-20">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="single-about-chose-us mb-95">
                                {{-- <div class="about-choose-img">
                                    <img src="{{ asset('assets/img/icon-img/service-9.png') }}" alt="">
                                </div> --}}
                                <div class="about-choose-content text-blue">
                                    <h3>Brief History</h3>
                                    <p>Established in 1981, NIIT Limited, a global leader in Skills and Talent Development, offers multi-disciplinary learning management and training delivery solutions to corporations, institutions, and individuals in over 40 countries. NIIT has three main lines of business across the globe- Corporate Learning Group, Skills and Careers Group, and School Learning Group.</p>
                                    <br>
                                    <p>NIIT established its presence in Nigeria in 1999 and since then affirmed its support to prepare the youth in the country for lucrative IT careers. NIIT trains over 16,000 students in Nigeria every year and has shaped the careers of over 160,000 students in the past 16 years. Now NIIT has operational centres in Abuja and Kaduna and is acknowledged as the undisputed leader in the country's IT training and education segment.</p>

                                    <br>

                                    <h3>Why NIIT? </h3>
                                    <p>NIIT is Africa’s largest information technology Education provider. With over 36 years in IT training, boasting over 5 million students worldwide. Besides the many awards achieved by NIIT, like ‘The Most Trusted Education Brand 2017’ and ‘Best Innovation Brand in the Education Sector’.</p>
                                    <br>
                                    <p>NIIT has many career programs that have helped thousands of students who have decided to prepare for a career in IT along college. NIIT are the pioneers in providing training on every latest technology like Big Data, Digital Marketing and Java. NIIT has made her learning methodology to be project based.</p>
                                    <br>
                                    <p>NIIT is now a Global Education & Training company with presence in over 40 countries. NIIT has highly experience and certified instructors, globally recognized certification, learning resources like physical courseware, reference sites, online assessment and many more for each student.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="about-img">
                    <img src="assets/img/bg/about.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="fun-fact-area bg-img pt-130 pb-100" style="background-image:url(assets/img/bg/bg-6.jpg);">
    <div class="container">
        <div class="section-title-3 section-shape-hm2-2 white-text text-center mb-100">
            <h2><span>Fun</span> Fact</h2>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="single-count mb-30 count-one count-white">
                    <div class="count-img">
                        <img src="assets/img/icon-img/funfact-2.png" alt="">
                    </div>
                    <div class="count-content">
                        <h2 class="count">200</h2>
                        <span>GRADUATE</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="single-count mb-30 count-three count-white">
                    <div class="count-img">
                        <img src="assets/img/icon-img/achieve-4.png" alt="">
                    </div>
                    <div class="count-content">
                        <h2 class="count">160</h2>
                        <span>AWARD WINNING</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="single-count mb-30 count-four count-white">
                    <div class="count-img">
                        <img src="assets/img/icon-img/funfact-2.png" alt="">
                    </div>
                    <div class="count-content">
                        <h2 class="count">200</h2>
                        <span>FACULTIES</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="achievement-area pt-130 pb-115">
    <div class="container">
        <div class="section-title mb-75">
            <h2>What <span>People Say</span></h2>
            <p>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim <br>veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
        </div>
        <div class="testimonial-slider-wrap mt-45">
            <div class="testimonial-text-slider">
                <div class="testi-content-wrap">
                    <div class="testi-big-img">
                        <img alt="" src="assets/img/testimonial/testi-b1.jpg">
                    </div>
                   <div class="row no-gutters">
                       <div class="ml-auto col-lg-6 col-md-6">
                           <div class="testi-content bg-img default-overlay" style="background-image:url(assets/img/bg/testi.png);">
                                <div class="quote-style quote-left">
                                   <i class="fa fa-quote-left"></i>
                                </div>
                               <p>Lorem ipsum dolor sit amet, conse ctetur adipi sicing elit, sed do eiusm od tempor incidi dunt ut labore et dolore magna aliqua. Ut enim  fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit </p>
                                <div class="testi-info">
                                   <h5>AYESHA HOQUE</h5>
                                   <span>Students Of AMMT Department</span>
                                </div>
                                <div class="quote-style quote-right">
                                   <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="testi-arrow">
                                    <img alt="" src="assets/img/icon-img/testi-icon.png">
                                </div>
                           </div>
                       </div>
                   </div>
                </div>
                <div class="testi-content-wrap">
                   <div class="testi-big-img">
                        <img alt="" src="assets/img/testimonial/testi-b3.jpg">
                    </div>
                   <div class="row no-gutters">
                        <div class="ml-auto col-lg-6 col-md-6">
                           <div class="testi-content bg-img default-overlay" style="background-image:url(assets/img/bg/testi.png);">
                                <div class="quote-style quote-left">
                                   <i class="fa fa-quote-left"></i>
                                </div>
                               <p>Lorem ipsum dolor sit amet, conse ctetur adipi sicing elit, sed do eiusm od tempor incidi dunt ut labore et dolore magna aliqua. Ut enim  fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis</p>
                                <div class="testi-info">
                                   <h5>Tayeb Rayed</h5>
                                   <span>Students Of AMMT Department</span>
                                </div>
                                <div class="quote-style quote-right">
                                   <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="testi-arrow">
                                    <img alt="" src="assets/img/icon-img/testi-icon.png">
                                </div>
                           </div>
                       </div>
                   </div>
                </div>
                <div class="testi-content-wrap">
                    <div class="testi-big-img">
                        <img alt="" src="assets/img/testimonial/testi-b2.jpg">
                    </div>
                   <div class="row no-gutters">
                        <div class="ml-auto col-lg-6 col-md-6">
                           <div class="testi-content bg-img default-overlay" style="background-image:url(assets/img/bg/testi.png);">
                                <div class="quote-style quote-left">
                                   <i class="fa fa-quote-left"></i>
                                </div>
                               <p>Lorem ipsum dolor sit amet, conse ctetur adipi sicing elit, sed do eiusm od tempor incidi dunt ut labore et dolore magna aliqua. Ut enim  fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui. Sed ut perspiciatis unde omnis iste natus error sit </p>
                                <div class="testi-info">
                                   <h5>Robiul siddikee</h5>
                                   <span>Students Of AMMT Department</span>
                                </div>
                                <div class="quote-style quote-right">
                                   <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="testi-arrow">
                                    <img alt="" src="assets/img/icon-img/testi-icon.png">
                                </div>
                           </div>
                        </div>
                   </div>
                </div>
                <div class="testi-content-wrap">
                   <div class="testi-big-img">
                        <img alt="" src="assets/img/testimonial/testi-b2.jpg">
                    </div>
                    <div class="row no-gutters">
                       <div class="ml-auto col-lg-6 col-md-6">
                           <div class="testi-content bg-img default-overlay" style="background-image:url(assets/img/bg/testi.png);">
                                <div class="quote-style quote-left">
                                   <i class="fa fa-quote-left"></i>
                                </div>
                               <p>Lorem ipsum dolor sit amet, conse ctetur adipi sicing elit, sed do eiusm od tempor incidi dunt ut labore et dolore magna aliqua. Ut enim  fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit </p>
                                <div class="testi-info">
                                   <h5>Modhu Dada</h5>
                                   <span>Students Of AMMT Department</span>
                                </div>
                                <div class="quote-style quote-right">
                                   <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="testi-arrow">
                                    <img alt="" src="assets/img/icon-img/testi-icon.png">
                                </div>
                           </div>
                       </div>
                   </div>
                </div>
            </div>
            <div class="testimonial-image-slider">
                <div class="sin-testi-image">
                    <img src="assets/img/testimonial/testi-s2.jpg" alt="">
                </div>
                <div class="sin-testi-image">
                    <img src="assets/img/testimonial/testi-s1.jpg" alt="">
                </div>
                <div class="sin-testi-image">
                    <img src="assets/img/testimonial/testi-s3.jpg" alt="">
                </div>
                <div class="sin-testi-image">
                    <img src="assets/img/testimonial/testi-s3.jpg" alt="">
                </div>
            </div>
        </div>
        <div class="testimonial-text-img">
            <img alt="" src="assets/img/icon-img/testi-text.png">
        </div>
    </div>
</div> --}}

{{-- 
<div class="brand-logo-area pb-130">
    <div class="container">
        <div class="brand-logo-active owl-carousel">
            <div class="single-brand-logo">
                <a href="#"><img src="assets/img/brand-logo/1.png" alt=""></a>
            </div>
            <div class="single-brand-logo">
                <a href="#"><img src="assets/img/brand-logo/2.png" alt=""></a>
            </div>
            <div class="single-brand-logo">
                <a href="#"><img src="assets/img/brand-logo/3.png" alt=""></a>
            </div>
            <div class="single-brand-logo">
                <a href="#"><img src="assets/img/brand-logo/4.png" alt=""></a>
            </div>
            <div class="single-brand-logo">
                <a href="#"><img src="assets/img/brand-logo/5.png" alt=""></a>
            </div>
            <div class="single-brand-logo">
                <a href="#"><img src="assets/img/brand-logo/6.png" alt=""></a>
            </div>
            <div class="single-brand-logo">
                <a href="#"><img src="assets/img/brand-logo/2.png" alt=""></a>
            </div>
        </div>
    </div>
</div> --}}

@endsection