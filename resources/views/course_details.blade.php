@extends('layouts.app')

@section('page_title', $course->title)
@section('page_description', strip_tags($course->shortContent))

@section('og_url', url()->full())
@section('og_title', $course->title)
@section('og_description', strip_tags($course->shortContent))
@section('og_type', 'course')
@section('og_image', $course->image_url)

@section('custom_css')
<style type="text/css">
    .content_details p { line-height: 200%; margin: 20px 0; }
    .content_details ul { list-style: inside; padding-left: 20px; margin-bottom: 25px; }
    .content_details h5 { margin: 0 0 20px; }
    .course-tab-list a:before { content: none; }
</style>
@endsection

@section('content')

<div class="breadcrumb-area">
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-2 pt-100 pb-95" style="background-image:url({{ $course->image_url }});">
        <div class="container">
            <h2 style="font-size: 28px;">{{ $course->title }}</h2>
            {{-- <p>{{ strip_tags($course->shortContent) }}</p> --}}
        </div>
    </div>
    <div class="breadcrumb-bottom">
        <div class="container">
            <ul>
                <li><a href="{{ route('homepage') }}">Home</a> <span><i class="fa fa-angle-double-right"></i>Course Details</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="course-details-area pt-60">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="course-left-wrap mr-40">
                    {{-- <div class="apply-area">
                        <img src="{{ $course->photo }}" alt="">
                        <div class="course-apply-btn">
                            <a href="#" class="default-btn">APPLY NOW</a>
                        </div>
                    </div> --}}
                    
                    <div class="course-tab-list nav pt-0 pb-25 mb-35"> {{-- class="course-tab-list nav pt-40 pb-25 mb-35" --}}
                        <a class="active" href="#course-details-1" data-toggle="tab" >
                            <h4>Overview  </h4>
                        </a>
                        {{-- <a href="#course-details-2" data-toggle="tab">
                            <h4>Instructor </h4>
                        </a>
                        <a href="#course-details-3" data-toggle="tab">
                            <h4> Reviews </h4>
                        </a> --}}
                    </div>
                    <div class="tab-content jump">
                        <div class="tab-pane active" id="course-details-1">
                            <div class="over-view-content">
                                {{-- <h4>COURSE  DETAILS</h4>
                                <h5>Course Name : {{ $course->title }}</h5> --}}
                                <div class="pb-80 content_details" style="border-bottom: 1px solid #eeeeee;">
                                    {!! $course->details !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="related-course pt-70">
                        <div class="related-title mb-45 mrg-bottom-small">
                            <h3>Related Courses</h3>
                            {{-- <p>Hempor incididunt ut labore et dolore mm, itation ullamco laboris <br>nisi ut aliquip. </p> --}}
                        </div>
                        <div class="related-slider-active">
                            @foreach ($relatedCourses as $relatedCourse)
                                <div class="single-course mb-30">
                                    <div class="course-img" style="height: 145px; background-size: cover;">
                                        <a href="{{ route('courses.show', $relatedCourse->slug) }}"><img src="{{ $relatedCourse->photo }}" alt=""></a>
                                        @if ($relatedCourse->discount)
                                        <span class="new-course">{{ $relatedCourse->discount }}% discount</span>
                                        @endif
                                    </div>
                                    <div class="course-content">
                                        <h4>
                                            <a href="{{ route('courses.show', $relatedCourse->slug) }}">{{ $relatedCourse->title }}</a>
                                        </h4>
                                    </div>

                                    <div class="course-position-content" style="opacity: 1;visibility: visible;">
                                        <div class="credit-duration-wrap">
                                            <div class="sin-credit-duration">
                                                <i class="fa fa-clock-o"></i>
                                                <span> 
                                                    <abbr title="{{ $relatedCourse->period }}">
                                                        {{ $month = $relatedCourse->duration }}
                                                        {{ str_plural('month', $month) }}
                                                    </abbr>
                                                </span>
                                            </div>
                                            <div class="sin-credit-duration">
                                                @if ($course->cost > 0)
                                                    <i class="fa fa-money"></i>
                                                    <span>&#x20a6;{{ number_format($relatedCourse->cost) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="course-btn">
                                            {{-- <a class="default-btn" href="#">APPLY NOW</a> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="sidebar-style sidebar-res-mrg-none">
                    <div class="sidebar-search mb-40">
                        <div class="sidebar-title mb-40">
                            <h4>Search</h4>
                        </div>
                        <form action="{{ route('courses.search') }}" method="GET">
                            <input type="text" placeholder="Search courses" name="q">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
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
      "description": "{{ strip_tags(str_replace('Course Description', '', $course->details)) }}",
      "name": "{{ $course->title }}",
      "image": "{{ $course->image_url }}",
      "offers": {
        "@type": "Offer",
        "availability": "http://schema.org/InStock",
        "price": "{{ $course->cost }}",
        "priceCurrency": "NG",
        "discount": "{{ $course->discount }}"
      }
    }
</script>

@endsection