@extends('layouts.app')

@section('page_title', 'Our Courses - ' . config('app.name'))
@section('page_description', 'Take advantage of our wide variety of courses available.')

@section('custom_css')
<style type="text/css">
    .search_input {
        background-color: #fff;
        border: 1px solid #ddd;
        color: #333;
        line-height: 30px;
        padding: 0 50px 0 20px;
        width: 100%;
        height: 40px;
    }

    .search_button {
        position: absolute;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        right: 30px;
        height: 100%;
        background-color: transparent;
        padding: 0;
        border: none;
        font-size: 16px;
        color: #333;
    }

    @media (max-width: 767px) {
        .search_button {
            top: 75%;
        }
    }
</style>
@endsection

@section('content')

<div class="breadcrumb-area">
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-3 pt-100 pb-95 page_banner">
        <div class="container">
            <h2 style="font-size: 28px;">Our Courses</h2>
            <p>Take advantage of our wide variety of courses available.</p>
        </div>
    </div>
    <div class="breadcrumb-bottom">
        <div class="container">
            <ul>
                <li><a href="{{ route('homepage') }}">Home</a> <span><i class="fa fa-angle-double-right"></i>Courses</span></li>
            </ul>
        </div>
    </div>
</div>

<div class="mt-40">&nbsp;</div>

<div class="container mb-50">
    <div class="row">
        <div class="col-12">
            @include('commons._search_form')
        </div>
    </div>
</div>

@foreach ($categories as $category)

    @if ($category->courses->count() > 0)

        <div class="course-area bg-img pt-10">
            <div class="container">
                <div class="section-title mb-75 course-mrg-small">
                    <h2 style="font-size: 40px;"> <span>{{ $category->name }}</span></h2>
                    <p style="width: 65%;" class="mb-30">{{ $category->shortDescription }} </p>
                    <h5 style="font-weight: 700;">
                        AVAILABLE:
                        <span style="color: #1b55e2;">{{ $count = $category->courses->count() }}
                        {{ str_plural('COURSE', $count) }}</span>
                    </h5>
                </div>
                <div class="course-slider-active-3">
                    @foreach ($category->courses as $course)

                        <div class="single-course mb-10">
                            <div class="course-img" style="height: 145px; background-size: cover;">
                                <a href="{{ route('courses.show', $course->slug) }}">
                                    <img src="{{ $course->photo }}" alt="">
                                </a>
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

                            <div class="course-position-content" style="opacity: 1;visibility: visible;">
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
                                <div class="course-btn">
                                    {{-- <a class="default-btn" href="#">APPLY NOW</a> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    @endif

@endforeach

@endsection
