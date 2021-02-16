@extends('layouts.app')

@section('page_title', $event->title)
@section('page_description', strip_tags($event->shortContent))

@section('og_url', url()->full())
@section('og_title', $event->title)
@section('og_description', strip_tags($event->shortContent))
@section('og_type', 'event')
@section('og_image', $event->image_url)

@section('custom_css')
<style type="text/css">
    .content_details p {
        line-height: 200%;
    }
    .course-tab-list a:before {
        content: none;
    }

    /*.page_alert {
        top: 0;
        left: 0;
        border-radius: 0;
        position: fixed;
        width: 100%;
    }*/
</style>
@endsection

@section('content')

<div class="breadcrumb-area">
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-2 pt-100 pb-95" style="background-image:url({{ $event->image_url }});">
        <div class="container">
            <h2 style="font-size: 28px;">{{ $event->title }}</h2>
            {{-- <p>{{ strip_tags($event->shortContent) }}</p> --}}
        </div>
    </div>
    <div class="breadcrumb-bottom">
        <div class="container">
            <ul>
                <li><a href="{{ route('homepage') }}">Home</a> <span><i class="fa fa-angle-double-right"></i>Event Details</span></li>
            </ul>
        </div>
    </div>
</div>

<div class="event-details-area pt-130">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="event-left-wrap mr-40">
                    <div class="event-description">
                        <div class="description-date-social mb-20">
                            <div class="description-date-time">
                                <div class="description-date pt-2">
                                    <small style="color:#fff;">STARTS</small>
                                    <span class="event-date">{{ $event->start_date->format('jS') }}</span>
                                    <span>{{ $event->start_date->format('M') }}</span>
                                </div>
                                @if ($event->start_date != $event->end_date)
                                    <div class="description-date pt-2">
                                        <small style="color:#fff;">ENDS</small>
                                        <span class="event-date">{{ $event->end_date->format('jS') }}</span>
                                        <span>{{ $event->end_date->format('M') }}</span>
                                    </div>
                                @endif

                                <div class="description-meta-wrap pt-10">
                                    @if ($event->time)
                                        <div class="description-meta">
                                            <i class="fa fa-clock-o"></i>
                                            <span>{{ date('h:ia', strtotime($event->time)) }}</span>
                                        </div>
                                    @endif

                                    @if ($event->venue)
                                        <div class="description-meta">
                                            <i class="fa fa-location-arrow"></i>
                                            <span>{{ $event->venue }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="description-social-wrap">
                                <div class="description-social">
                                    <ul>
                                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                                <div class="description-btn">
                                    <a href="javascript:;"><i class="fa fa-share-alt"></i></a>
                                </div>
                            </div>
                        </div>

                        <h3>{{ $event->title }}</h3>

                        @if (! is_null($event->registration_start_date) && $event->registration_start_date <= today() && $event->registration_end_date >= today())
                            <a href="#register" class="btn btn-primary" style="background: #1b55e2; color:#fff;">Book a seat now</a>
                        @endif


                        <div class="pb-50 pt-50 content_details" style="border-bottom: 1px solid #eeeeee;">
                            {!! $event->details !!}
                        </div>

                        @if (! is_null($event->registration_end_date) && $event->registration_end_date < today())
                            <div class="seat-book-wrap bg-img mt-80 " style="background-color:#f4f7fc;">
                                <div class="seat-book-title text-center" style="font-size: 16px;">
                                   <span> Registration closed <abbr title="{{ $event->registration_end_date->format('jS M, Y') }}" style="color: #1b55e2;">{{ $event->registration_end_date->diffForHumans() }}</abbr></span>

                                    <p style="color: #333; margin-top: 15px;">
                                        <strong>We regret the inconveniences . Contact us for more info</strong> <br>
                                        @if (config('app.phone'))
                                        <span>{{ config('app.phone') }}</span> <br>
                                        @endif
                                        @if (config('app.email'))
                                        <span>{{ config('app.email') }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif
                        
                        @if (! is_null($event->registration_start_date) && $event->registration_start_date <= today() && $event->registration_end_date >= today())
                            <div class="seat-book-wrap bg-img mt-80 " style="background-color:#f4f7fc;">
                                <div class="seat-book-title text-center">
                                    <h3 style="color: #1b55e2;">Book Your Seat Now</h3>
                                    <p class="text-muted"> 
                                        Book your seat for this event by filling the form below. <br>
                                        Registration opened {{ $event->registrationStarts }} and closes {{ $event->registrationEnds }}
                                    </p>
                                </div>
                                <div class="seat-book-form" id="register">
                                    
                                    <form method="POST" action="{{ route('attendees.store', $event->uid) }}" autocomplete="off">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                @error('first_name')
                                                  <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                                <input name="first_name" placeholder="First Name" type="text" value="{{ old('first_name') }}" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                @error('last_name')
                                                  <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                                <input placeholder="Last Name" type="text" name="last_name" value="{{ old('last_name') }}" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                @error('phone')
                                                  <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                                <input name="phone" placeholder="Phone Number" type="text" value="{{ old('phone') }}" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                @error('email')
                                                  <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                                <input placeholder="Email" type="email" name="email" value="{{ old('email') }}" required>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                @error('gender')
                                                  <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                                <select name="gender" required>
                                                    <option value="">Select gender</option>
                                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-12">
                                                {{-- <textarea placeholder="Message"></textarea> --}}
                                                <button class="seat-book-btn" type="submit">BOOK NOW</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        @elseif (! is_null($event->registration_start_date) && $event->registration_start_date > today())

                            <div class="seat-book-wrap bg-img mt-80 " style="background-color:#f4f7fc;">
                                <div class="seat-book-title text-center" style="font-size: 16px;">
                                   <span> Registration opens <abbr title="{{ $event->registration_start_date->format('jS M, Y') ?? '' }}" style="color: #1b55e2;">{{ $event->registration_start_date->diffForHumans() ?? '' }}</abbr></span>

                                    <p style="color: #333; margin-top: 15px;">
                                        <strong>We love your eagerness. Contact us for more info</strong> <br>
                                        @if (config('app.phone'))
                                        <span>{{ config('app.phone') }}</span> <br>
                                        @endif
                                        @if (config('app.email'))
                                        <span>{{ config('app.email') }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                        @endif

                        <div class="location-area mt-90 mb-90">
                            {{-- <div id="location"></div> --}}
                            &nbsp;
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="sidebar-style">
                    <div class="sidebar-recent-post mb-35">
                        <div class="sidebar-title mb-40">
                            <h4>More Events</h4>
                        </div>
                        <div class="recent-post-wrap">
                            @foreach ($moreEvents as $moreEvent)
                                <div class="single-recent-post">
                                    <div class="recent-post-content">
                                        <h5 style="line-height: 150%;"><a href="{{ $moreEvent->slug }}">{{ $moreEvent->title }}</a></h5>
                                        {{-- <p>Datat non proident qui offici.hafw adec qart.</p> --}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="sidebar-category mb-40">
                        <div class="sidebar-title mb-40">
                            <h4>Course Category</h4>
                        </div>
                        <div class="category-list">
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="#">{{ $category->name }} <span>{{ $category->courses->count() }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Course",
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.5"
      },
      "description": "{{ strip_tags($event->details) }}",
      "name": "{{ $event->title }}",
      "image": "{{ $event->image_url }}",
      "offers": {
        "@type": "Offer",
        "availability": "http://schema.org/InStock",
        "startDate": "{{ $event->start_date }}",
        "endDate": "{{ $event->end_date }}",
        "time": "{{ $event->time }}"
      }
    }
</script>

@endsection