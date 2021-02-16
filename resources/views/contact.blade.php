@extends('layouts.app')

@section('page_title', 'Contact ' . config('app.name'))

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
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-3 pt-100 pb-95 page_banner">
        <div class="container">
            <h2>Contact Us</h2>
            <p>Say hello.</p>
        </div>
    </div>
    <div class="breadcrumb-bottom">
        <div class="container">
            <ul>
                <li><a href="{{ route('homepage') }}">Home</a> <span><i class="fa fa-angle-double-right"></i>Contact Us</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="contact-area pt-130 pb-130">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="contact-map mr-70">
                    <div id="map"></div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="contact-form">
                    <div class="contact-title mb-45">
                        <h2>Stay <span>Connected</span></h2>
                        <p>Say hello or make enquires about anything related to NIIT.</p>
                    </div>

                    <form action="{{ route('submit_contact_form') }}" method="POST">
                        @csrf()

                        @error('name')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                        <input name="name" placeholder="Full Name *" type="text" maxlength="80" required>
                        
                        @error('email')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                        <input name="email" placeholder="Email *" type="email" maxlength="80" required>

                        @error('subject')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                        <input name="subject" placeholder="Subject / Title *" type="text" maxlength="120" required>

                        @error('message')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                        <textarea name="message" placeholder="Message *" maxlength="1500" required></textarea>

                        <button class="submit btn-style" type="submit">SEND MESSAGE</button>
                    </form>
                    <p class="form-messege"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="contact-info-area bg-img pt-180 pb-140 default-overlay" style="background-image:url({{ asset('assets/img/bg/bg-2.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="single-contact-info mb-30 text-center">
                    <div class="contact-info-icon">
                        <span><i class="fa fa-home"></i></span>
                    </div>
                    <p>{{ config('app.address') }}</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="single-contact-info mb-30 text-center">
                    <div class="contact-info-icon">
                        <span><i class="fa fa-phone"></i></span>
                    </div>
                    <div class="contact-info-phn">
                        <div class="info-phn-number">
                            <p>{{ config('app.phone') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="single-contact-info mb-30 text-center">
                    <div class="contact-info-icon">
                        <span><i class="fa fa-envelope-o"></i></span>
                    </div>
                    <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection