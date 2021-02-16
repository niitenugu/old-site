@extends('layouts.app')

@section('page_title', $job->title)
@section('page_description', strip_tags($job->shortContent))

@section('og_url', url()->full())
@section('og_title', $job->title)
@section('og_description', strip_tags($job->shortContent))
@section('og_type', 'job')
@section('og_image', config('app.image'))

@section('custom_css')
<style type="text/css">
    .content_details p {
        line-height: 200%;
    }
    .course-tab-list a:before {
        content: none;
    }
</style>
@endsection

@section('content')

<div class="breadcrumb-area">
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-2 pt-80 pb-60">
        <div class="container">
            <h2 style="font-size: 28px;">{{ $job->title }}</h2>
        </div>
    </div>
    <div class="breadcrumb-bottom">
        <div class="container">
            <ul>
                <li><a href="{{ route('homepage') }}">Home</a> <span><i class="fa fa-angle-double-right"></i>Job Details</span></li>
            </ul>
        </div>
    </div>
</div>

<div class="event-details-area pt-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="event-left-wrap mr-40">
                    <div class="event-description">
                        <h3>{{ $job->title }}</h3>
                        <div class="pb-50 pt-50 content_details" style="border-bottom: 1px solid #eeeeee;">
                            {!! $job->details !!}
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
      "description": "{{ strip_tags($job->details) }}",
      "name": "{{ $job->title }}",
      "image": "{{ config('app.image') }}",
      "offers": {
        "@type": "Offer",
        "availability": "http://schema.org/InStock"
      }
    }
</script>

@endsection