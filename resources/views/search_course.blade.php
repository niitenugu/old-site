@extends('layouts.app')

@section('page_title', 'Search Result')
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
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-2 pt-100 pb-95" style="background-image:url({{ asset('assets/img/bg/page-banner.jpg') }});">
        <div class="container">
            <h2 style="font-size: 28px;">Search Result</h2>
            <p>Take advantage of our wide variety of courses available.</p>
        </div>
    </div>
    <div class="breadcrumb-bottom">
        <div class="container">
            <ul>
                <li><a href="{{ route('homepage') }}">Home</a> <span><i class="fa fa-angle-double-right"></i>Search Result</span></li>
            </ul>
        </div>
    </div>
</div>

<div class="mt-40">&nbsp;</div>

<div class="container mb-10">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            @if ($courses->count() > 0)
                Total Result: 
                <span style="color: #1b55e2; font-weight:700;">{{ $count = $courses->total() }}
                {{ str_plural('result', $count) }}</span>
            @else
                Total Result: 0 results
            @endif
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            @include('commons._search_form')
        </div>
    </div>
</div>

<div class="event-area pt-30 pb-130">
    <div class="container">

        @if ($courses->count() > 0)

            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-event mb-55 event-gray-bg">
                            <div class="event-img" style="background-size: cover; height: 195px;">
                                <a href="{{ route('courses.show', $course->slug) }}"><img src="{{ $course->photo }}" alt=""></a>
                                @if ($course->discount)
                                    <div class="event-date-wrap">
                                        <span class="event-date">{{ $course->discount }}%</span>
                                        <span>OFF</span>
                                    </div>
                                @endif
                            </div>
                            <div class="event-content">
                                <h3>
                                    <a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                </h3>
                                <p class="pb-30">
                                    {{-- {{ $course->shortContent }} --}}
                                </p>
                                <div class="event-meta-wrap">
                                    <div class="event-meta">
                                        <i class="fa fa-clock-o"></i>
                                        <span>
                                            <abbr title="{{ $course->period }}">
                                                {{ $month = $course->duration }}
                                                {{ str_plural('month', $month) }}
                                            </abbr>
                                        </span>
                                    </div>
                                    <div class="event-meta">
                                        @if ($course->cost > 0)
                                            <i class="fa fa-money"></i>
                                            <span>&#x20a6;{{ number_format($course->cost) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach 

            </div>
            <div class="pro-pagination-style text-center mt-25">
                <ul>
                    <li><a class="prev" href="{{ $courses->appends($_GET)->previousPageUrl() }}"><i class="fa fa-angle-double-left"></i></a></li>
                    {{--<li><a href="javascript:;">1</a></li>
                    <li><a href="#">2</a></li> --}}
                    <span class="pl-20 pr-20">Page {{ $courses->currentPage() }} of {{ $courses->lastPage() }}</span>
                    <li><a class="next" href="{{ $courses->appends($_GET)->nextPageUrl() }}"><i class="fa fa-angle-double-right"></i></a></li>
                </ul>
            </div>

        @else

            <div class="col-12 pt-30 pb-30 text-center" style="background:#f6f6f6;">
                <span style="font-size:20px;display:block;">No results found!</span> <br>
                <a href="{{ route('courses.index') }}" class="btn btn-primary btn-sm">View all courses</a>
            </div>

        @endif 

    </div>
</div>

@endsection
