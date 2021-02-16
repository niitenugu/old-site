@extends('layouts.app')

@section('page_title', config('app.name'))

@section('custom_css')
<style type="text/css">
    .single-course .course-content {
        box-shadow: 0 2px 12px rgba(225, 225, 225, 0.51);
    }

    .page_alert {
        top: 0;
        left: 0;
        border-radius: 0;
        position: fixed;
        width: 100%;
    }
</style>
@endsection

@section('content')


@include('layouts.partials.slider')

@if ($activeScholarship)
    @include('layouts.partials.scholarship_form')
@endif

{{-- <div class="choose-us section-padding-1">
    <div class="container-fluid">
        <div class="row no-gutters choose-negative-mrg">
            <div class="col-lg-3 col-md-6">
                <div class="single-choose-us choose-bg-light-blue">
                    <div class="choose-img">
                        <img class="animated" src="assets/img/icon-img/service-1.png" alt="">
                    </div>
                    <div class="choose-content">
                        <h3>Scholarship Facility</h3>
                        <p>magna aliqua. Ut enim ad minim veniam conse ctetur adipisicing elit, sed do exercitation. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-choose-us choose-bg-yellow">
                    <div class="choose-img">
                        <img class="animated" src="assets/img/icon-img/service-2.png" alt="">
                    </div>
                    <div class="choose-content">
                        <h3>Scholarship Facility</h3>
                        <p>magna aliqua. Ut enim ad minim veniam conse ctetur adipisicing elit, sed do exercitation. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-choose-us choose-bg-blue">
                    <div class="choose-img">
                        <img class="animated" src="assets/img/icon-img/service-3.png" alt="">
                    </div>
                    <div class="choose-content">
                        <h3>Scholarship Facility</h3>
                        <p>magna aliqua. Ut enim ad minim veniam conse ctetur adipisicing elit, sed do exercitation. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-choose-us choose-bg-green">
                    <div class="choose-img">
                        <img class="animated" src="assets/img/icon-img/service-4.png" alt="">
                    </div>
                    <div class="choose-content">
                        <h3>Scholarship Facility</h3>
                        <p>magna aliqua. Ut enim ad minim veniam conse ctetur adipisicing elit, sed do exercitation. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="about-us pt-130 pb-130">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="about-content">
                    <div class="section-title section-title-green mb-30">
                        <h2>About <span>Us</span></h2>
                        <p>NIIT are the pioneers in providing training on every latest technology like Big Data, Digital Marketing and Java. NIIT has made her learning methodology to be project based. </p>
                    </div>
                    <p>Established in 1981, NIIT Limited, a global leader in Skills and Talent Development, offers multi-disciplinary learning management and training delivery solutions to corporations, institutions, and individuals in over 40 countries. </p>
                    <div class="about-btn mt-45">
                        <a class="default-btn" href="{{ route('about') }}">ABOUT US</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="about-img default-overlay">
                    <img src="assets/img/bg/youtube-video.svg" alt="">
                    <a class="video-btn video-popup" href="https://www.youtube.com/watch?v=k_2apO9Nx1U">
                        <img class="animated" src="assets/img/bg/video-icon.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="admission-area pt-100 pb-100 bg-img-position">
    <div class="container">
        <div class="admission-title text-center mb-60">
            <h2>Available Courses</h2>
            <p>Check out the list of our available courses that will help you actualize your coding and IT related dream. You can also click on view all to see the full list of courses available. </p>
        </div>
        
        <div class="tab-content jump">
            <div class="tab-pane active" id="course-categorie-1">
                <div class="course-slider-active-2 nav-style-1 owl-carousel">
                    @foreach ($categories as $category)

                        @if ($category->courses->count() > 0)

                            <div class="course-categorie-bundle">
                                @foreach ($category->courses->slice(0, 2) as $course)

                                    <div class="single-course mb-30" style="margin-bottom: 50px;">
                                        <div class="course-img" style="height: 145px; background-size: cover; width: 100%;">
                                            <a href="{{ route('courses.show', $course->slug) }}"><img src="{{ $course->photo }}" alt=""></a>
                                            @if ($course->discount)
                                            <span class="new-course">{{ $course->discount }}% discount</span>
                                            @endif
                                        </div>
                                        
                                        <div class="course-content">
                                            <h4>
                                                <a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                            </h4>
                                            {{-- <p>{{ $course->shortContent }}</p> --}}
                                        </div>

                                        <div class="course-position-content">
                                            <div class="credit-duration-wrap">
                                                <div class="sin-credit-duration">
                                                    <i class="fa fa-clock-o"></i>
                                                    <span> 
                                                        <abbr title="{{ $course->period }}">
                                                            {{ $month = $course->duration }}
                                                            {{ str_plural('month', $month) }}
                                                        </abbr>
                                                    </span>
                                                </div>
                                                <div class="sin-credit-duration">
                                                    @if ($course->cost > 0)
                                                        <i class="fa fa-money"></i>
                                                        <span>&#x20a6;{{ number_format($course->cost) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- <div class="course-btn">
                                                <a class="default-btn" href="#">APPLY NOW</a>
                                            </div> --}}
                                            {{-- 
                                                Remeber to visit style.css and adjust the following line;

                                                Hover (Transition)
                                                Line 2842: change top to 78%
                                                
                                                Normal (Transition)
                                                Line 2803
                                                
                                                You can change the height here
                                                Line 2790
                                            --}}
                                        </div>
                                    </div>
                                    
                                @endforeach 
                            </div>
                        @endif

                    @endforeach
                </div>
            </div>

            <div class="view-all text-center mt-20">
                <a class="default-btn" href="{{ route('courses.index') }}">VIEW ALL</a>
            </div>
        </div>
    </div>
</div>

<div class="event-area bg-img default-overlay pt-130 pb-130" style="background-image:url({{ asset('assets/img/bg/bg-2.jpg') }});">
    <div class="container">
        <div class="section-title mb-75">
            <h2><span>Our</span> Event</h2>
            <p style="color: #ffffff;">Stay informed with our latest events. Never miss any upcoming event. </p>
        </div>
        <div class="event-active owl-carousel nav-style-1">
            @forelse ($events as $event)
                <div class="single-event event-white-bg">
                    <div class="event-img" style="background-size: cover; height: 195px;">
                        <a href="{{ route('events.show', $event->slug) }}"><img src="{{ $event->photo }}" alt=""></a>
                        <div class="event-date-wrap">
                            <span class="event-date">{{ $event->start_date->format('jS') }}</span>
                            <span>{{ $event->start_date->format('M') }}</span>
                        </div>
                    </div>
                    <div class="event-content">
                        <h3 style="height: 85px;overflow: hidden;">
                            <a href="{{ route('events.show', $event->slug) }}">{{ $event->title }}</a>
                        </h3>
                        <p>{{-- {{ strip_tags($event->shortContent) }} --}}</p>
                        <div class="event-meta-wrap">
                            <div class="event-meta">
                                @if ($event->time)
                                <i class="fa fa-clock-o"></i>
                                <span>
                                    {{ date('h:ia', strtotime($event->time)) }}
                                </span>
                                @else
                                <span>&nbsp;</span>
                                @endif
                            </div>
                            {{-- <div class="event-meta">
                                <i class="fa fa-clock-o"></i>
                                <span>11:00 am</span>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 pt-30 pb-20 text-center" style="background:#f6f6f6;">
                    <span style="font-size:20px;display:block;">No upcoming event.</span> <br>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection

@section('custom_js')
<script type="text/javascript">
    // Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
    </script>
</script>
@endsection