<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="refresh" content="0;url=http://niit-enugu.com" />
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:url" content="@yield('og_url', config('app.url'))"/>
    <meta property="og:title" content="@yield('og_title', config('app.name'))"/>
    <meta property="og:description" content="@yield('og_description', config('app.desc'))" />
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:image" content="@yield('og_image', config('app.image'))" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    
    <meta content="NIIT" name="keywords">
    <meta content="{{ config('app.name') }}" name="author">
    <title>@yield('page_title', config('app.name'))</title>
    <meta name="description" content="@yield('page_description', config('app.desc'))">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/icon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <style type="text/css">
        .page_alert {
            top: 0;
            left: 0;
            border-radius: 0;
            position: fixed;
            width: 100%;
            z-index: 2;
        }
    </style>

    @yield('custom_css')

</head>

<body>
    <!--
@if (session('success'))
    <div class="alert alert-success text-center page_alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true"> ×</span></button>
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger text-center page_alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true"> ×</span></button>
        {{ session('error') }}
    </div>
@endif

@if ($errors->count() != 0)
    <div class="alert alert-danger text-center page_alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true"> ×</span></button>
        You have some errors on your form!
    </div>
@endif

<header class="header-area">
    <div class="header-top bg-img" style="background-image:url({{ asset('assets/img/bg/top-pattern.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-contact">
                        <ul>
                            @if (config('app.phone'))
                                <li>
                                    <i class="fa fa-phone"></i> {{ config('app.phone') }}
                                </li>
                            @endif

                            @if (config('app.email'))
                                <li>
                                    <i class="fa fa-envelope-o"></i>
                                    <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom sticky-bar clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-4">
                    <div class="logo">
                        <a href="{{ route('homepage') }}" style="font-weight:800; font-size: 20px; color: #1b55e2;">
                            {{-- <img alt="" src="assets/img/logo/logo.png"> --}}
                            {{ strtoupper(config('app.name')) }}
                        </a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-6 col-8">
                    <div class="menu-cart-wrap">
                        <div class="main-menu">
                            <nav>
                                <ul>

                                    <li><a href="{{ route('homepage') }}" class="{{ request()->route()->named('homepage') ? 'active' : '' }}"> HOME  </a></li>
                                    <li><a href="{{ route('courses.index') }}" class="{{ request()->is('courses*') ? 'active' : '' }}"> COURSES  </a></li>
                                    <li><a href="{{ route('events.index') }}" class="{{ request()->is('events*') ? 'active' : '' }}"> EVENTS  </a></li>
                                    <li><a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}"> ABOUT  </a></li>
                                    <li><a href="{{ route('careers.index') }}" class="{{ request()->is('careers*') ? 'active' : '' }}"> CAREERS  </a></li>
                                    <li><a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}"> CONTACT  </a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="cart-search-wrap">
                            <div class="header-search">
                                <button class="search-toggle">
                                    <i class="fa fa-search"></i>
                                </button>
                                <div class="search-content">
                                    <form action="{{ route('courses.search') }}" method="GET">
                                        <input type="text" name="q" placeholder="Search Courses" minlength="3">
                                        <button type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow">
                            <li><a href="{{ route('homepage') }}"> HOME  </a></li>
                            <li><a href="{{ route('courses.index') }}"> COURSES  </a></li>
                            <li><a href="{{ route('events.index') }}"> EVENTS  </a></li>
                            <li><a href="{{ route('about') }}"> ABOUT  </a></li>
                            <li><a href="{{ route('careers.index') }}"> CAREERS  </a></li>
                            <li><a href="{{ route('contact') }}"> CONTACT  </a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

    @yield('content')

<footer class="footer-area">
    <div class="footer-top bg-img default-overlay pt-130 pb-80" style="background-image:url(''); background-size: contain;background-repeat: repeat;background-position: 0 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="footer-widget mb-40">
                        <div class="footer-title">
                            <h4>ABOUT US</h4>
                        </div>
                        <div class="footer-about">
                            <p>NIIT are the pioneers in providing training on every latest technology like Big Data, Digital Marketing and Java.</p>
                            <div class="f-contact-info">
                                @if (config('app.address'))
                                    <div class="single-f-contact-info">
                                        <i class="fa fa-home"></i>
                                        <span>{{ config('app.address') }}</span>
                                    </div>
                                @endif

                                @if (config('app.email'))
                                    <div class="single-f-contact-info">
                                        <i class="fa fa-envelope-o"></i>
                                        <span>{{ config('app.email') }}</span>
                                    </div>
                                @endif

                                @if (config('app.phone'))
                                    <div class="single-f-contact-info">
                                        <i class="fa fa-phone"></i>
                                        <span>{{ config('app.phone') }}</span>
                                    </div>
                                @endif

                                @if (config('app.phone_2'))
                                    <div class="single-f-contact-info">
                                        <i class="fa fa-phone"></i>
                                        <span>{{ config('app.phone_2') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-1 col-md-1"></div>

                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-title">
                            <h4>QUICK LINK</h4>
                        </div>
                        <div class="footer-list">
                            <ul>
                                <li><a href="{{ route('homepage') }}">Home</a></li>
                                <li><a href="{{ route('courses.index') }}">Courses</a></li>
                                <li><a href="{{ route('events.index') }}">Events</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('careers.index') }}">Careers</a></li>
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="footer-widget negative-mrg-30 mb-40">
                        <div class="footer-title">
                            <h4>COURSES</h4>
                        </div>
                        <div class="footer-list">
                            <ul>
                                @foreach ($footerCourses as $footerCourse)
                                    <li><a href="{{ route('courses.show', $footerCourse->slug) }}">{{ $footerCourse->title }} </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-title">
                            <h4>GALLERY</h4>
                        </div>
                        <div class="footer-gallery">
                            <ul>
                                <li><a href="#"><img src="assets/img/gallery/gallery-1.png" alt=""></a></li>
                                <li><a href="#"><img src="assets/img/gallery/gallery-2.png" alt=""></a></li>
                                <li><a href="#"><img src="assets/img/gallery/gallery-3.png" alt=""></a></li>
                                <li><a href="#"><img src="assets/img/gallery/gallery-4.png" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-widget mb-40">
                        <div class="footer-title">
                            <h4>News Latter</h4>
                        </div>
                        <div class="subscribe-style">
                            <p>Dugiat nulla pariatur. Edeserunt mollit anim id est laborum. Sed ut perspiciatis unde</p>
                            <div id="mc_embed_signup" class="subscribe-form">
                                <form id="mc-embedded-subscribe-form" class="validate" novalidate="" name="mc-embedded-subscribe-form" method="post" action="#">
                                    <div id="mc_embed_signup_scroll" class="mc-form">
                                        <input class="email" type="email" required="" placeholder="Your E-mail Address" name="EMAIL">
                                        <div class="clear">
                                            <input id="mc-embedded-subscribe" class="button" type="submit" name="subscribe" value="SUBMIT">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="footer-bottom pt-15 pb-15">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-12">
                    <div class="copyright">
                        <p>
                            Copyright ©
                            <a href="{{ route('homepage') }}">{{ config('app.name') }}</a> {{ date('Y') }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="footer-menu-social">
                        <div class="footer-menu">
                            {{-- <ul>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul> --}}
                        </div>
                        <div class="footer-social">
                            <ul>
                                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="youtube" href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

@yield('custom_js')
 -->
</body>

</html>
