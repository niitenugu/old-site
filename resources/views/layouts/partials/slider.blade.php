<div class="slider-area">
    <div class="slider-active owl-carousel">

        @if ($activeScholarship)

             <div class="single-slider slider-height-1 bg-img" style="background-image:url({{ $activeScholarship->image_url }});">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="slider-content slider-animated-1 pt-230">
                                <h1 class="animated text-right  d-none d-sm-block" style="color: #EEBF49;">
                                    The NIIT Scholarship
                                </h1>
                                <p class="animated text-right  d-none d-sm-block" style="color: #1b55e2;width:100%;">This year's NIIT Scholarship is on going, <br>why not grab this opportunity to up your game.</p>
                                <div class="slider-btn text-right">
                                    <a class="animated default-btn btn-green-color" href="#registerNow">REGISTER NOW</a>
                                </div> 
                            </div>
                        </div>
                    </div>
                    {{-- <div class="slider-single-img slider-animated-1">
                        <img class="animated" src="assets/img/slider/single-slide-1.png" alt="">
                    </div> --}}
                </div>
            </div>

        @else


            <div class="single-slider slider-height-1 bg-img" style="background-image:url('https://res.cloudinary.com/niitenugu/image/upload/v1560158782/sliders/bg-1_e5tnon.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-md-7 col-12 col-sm-12">
                            <div class="slider-content slider-animated-1 pt-230">
                                <h1 class="animated">Invest in Your Future</h1>
                                <p class="animated">Enroll today and secure your future by acquring a skill in the ICT sector. NIIT has many career programs that will help prepare for a career in ICT along college.</p>
                                <div class="slider-btn">
                                    <a class="animated default-btn btn-green-color" href="{{ route('courses.index') }}">OUR COURSES</a>
                                    <a class="animated default-btn btn-white-color" href="{{ route('contact') }}">CONTACT US</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="slider-single-img slider-animated-1">
                        <img class="animated" src="assets/img/slider/single-slide-1.png" alt="">
                    </div> --}}
                </div>
            </div>
            
            <div class="single-slider slider-height-1 bg-img" style="background-image:url('https://res.cloudinary.com/niitenugu/image/upload/v1560158787/sliders/bg-2_fs6sd8.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-md-7 col-12 col-sm-12">
                            <div class="slider-content slider-animated-1 pt-230">
                                <h1 class="animated">Create Your Own World</h1>
                                <p class="animated">NIIT trains over 16,000 students in Nigeria every year and has shaped the careers of over 160,000 students in the past 16 years. Get enrolled today! </p>
                                <div class="slider-btn">
                                    <a class="animated default-btn btn-green-color" href="{{ route('about') }}">ABOUT US</a>
                                    <a class="animated default-btn btn-white-color" href="{{ route('contact') }}">CONTACT US</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="slider-single-img slider-animated-1">
                        <img class="animated" src="assets/img/slider/single-slide-1.png" alt="">
                    </div> --}}
                </div>
            </div>
        @endif

    </div>
</div>