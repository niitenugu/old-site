@extends('layouts.app')

@section('page_title', 'Job Openings - ' . config('app.name'))
@section('page_description', 'Checkout some of our current and available job openings.')

@section('content')

<div class="breadcrumb-area">
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-3 pt-100 pb-95 page_banner">
        <div class="container">
            <h2 style="font-size: 28px;">Job Openings</h2>
            <p>Checkout some of our current and available job openings.</p>
        </div>
    </div>
    <div class="breadcrumb-bottom">
        <div class="container">
            <ul>
                <li><a href="{{ route('homepage') }}">Home</a> <span><i class="fa fa-angle-double-right"></i>Job Openings</span></li>
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

        @if ($jobs->count() > 0)

            @foreach ($jobs as $job)
                <div class="single-event mb-40" style="border: 1px solid rgba(225,225,225,.51); border-radius: 4px;">
                    <div class="row">
                        <div class="col-lg-10 col-md-10">
                            <div class="event-content">
                                <a href="{{ route('careers.show', $job->slug) }}" style="display: block;">
                                    <h3>{{ $job->title }}</h3>
                                    <p style="margin-bottom: 12px;">{{ $job->shortContent }}</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 text-center d-none d-md-block d-lg-block">
                            <a href="{{ route('careers.show', $job->slug) }}">
                                <i class="fa fa-chevron-right" style="position: absolute; top: 50%; color: #1b55e2;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="pro-pagination-style text-center mt-25">
                <ul>
                    <li><a class="prev" href="{{ $jobs->appends($_GET)->previousPageUrl() }}"><i class="fa fa-angle-double-left"></i></a></li>
                    <span class="pl-20 pr-20">Page {{ $jobs->currentPage() }} of {{ $jobs->lastPage() }}</span>
                    <li><a class="next" href="{{ $jobs->appends($_GET)->nextPageUrl() }}"><i class="fa fa-angle-double-right"></i></a></li>
                </ul>
            </div>

        @else

            <div class="col-12 pt-30 pb-20 text-center" style="background:#f6f6f6;">
                <span style="font-size:20px;display:block;">No job openings.</span> <br>
            </div>

        @endif

    </div>
</div>

@endsection
