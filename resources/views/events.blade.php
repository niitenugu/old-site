@extends('layouts.app')

@section('page_title', 'Our Events - ' . config('app.name'))
@section('page_description', 'Stay informed with our latest events. Never miss any upcoming event.')

@section('content')

<div class="breadcrumb-area">
<div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-3 pt-100 pb-95 page_banner">
        <div class="container">
            <h2 style="font-size: 28px;">Our Events</h2>
            <p>Stay informed. Never miss any of our upcoming events.</p>
        </div>
    </div>
    <div class="breadcrumb-bottom">
        <div class="container">
            <ul>
                <li><a href="{{ route('homepage') }}">Home</a> <span><i class="fa fa-angle-double-right"></i>Our Events</span></li>
            </ul>
        </div>
    </div>
</div>

<div class="mt-40">&nbsp;</div>

{{-- <div class="container mb-10">
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
</div> --}}

<div class="event-area pt-30 pb-130">
    <div class="container">

        @if ($events->count() > 0)

            <div class="row">
                @foreach ($events as $event)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-event mb-55 event-gray-bg">
                            <div class="event-img" style="background-size: cover; height: 195px;">
                                <a href="{{ route('events.show', $event->slug) }}"><img src="{{ $event->photo }}" alt=""></a>
                                <div class="event-date-wrap">
                                    <span class="event-date" style="font-size: 10px;">
                                        <span class="event-date">{{ $event->start_date->format('jS') }}</span>
                                        <span>{{ $event->start_date->format('M') }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="event-content">
                                <h3 style="height: 85px;overflow: hidden;">
                                    <a href="{{ route('events.show', $event->slug) }}">{{ $event->title }}</a>
                                </h3>
                                <p>
                                    {{-- {{ strip_tags($event->shortContent) }} --}}
                                </p>
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
                                    <div class="event-meta">
                                        {{-- @if ($event->registration_start_date)
                                            <i class="fa fa-info"></i>
                                            <span>Registration required</span>
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
            <div class="pro-pagination-style text-center mt-25">
                <ul>
                    <li><a class="prev" href="{{ $events->appends($_GET)->previousPageUrl() }}"><i class="fa fa-angle-double-left"></i></a></li>
                    {{--<li><a href="javascript:;">1</a></li>
                    <li><a href="#">2</a></li> --}}
                    <span class="pl-20 pr-20">Page {{ $events->currentPage() }} of {{ $events->lastPage() }}</span>
                    <li><a class="next" href="{{ $events->appends($_GET)->nextPageUrl() }}"><i class="fa fa-angle-double-right"></i></a></li>
                </ul>
            </div>

        @else

            <div class="col-12 pt-30 pb-20 text-center" style="background:#f6f6f6;">
                <span style="font-size:20px;display:block;">No upcoming event.</span> <br>
            </div>

        @endif

    </div>
</div>

@endsection
