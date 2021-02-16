<div class="register-area bg-img pt-130 pb-130" style="background-color: #1b55e2;" id="registerNow">
    <div class="container">
        <div class="section-title-2 mb-75 ml-0 white-text">
            <h2>Register <span>Now</span></h2>
            <p>
                Complete the registration form below to participate in this year's scholarship. <br>
                An email will be sent to you confirming your successful registration.
                <br> 
                <strong>Registration ends {{ $activeScholarship->registration_end_date->format('d F, Y') }}, while examination is on {{ $activeScholarship->end_date->format('d F, Y') }}.</strong>
            </p>
        </div>
        <div class="register-wrap">
            <div id="register-3" class="mouse-bg" style="left: -1.49902%; right: -1.49902%; top: -5.46407%; bottom: -5.46407%; z-index: 1;">
                <div class="winter-banner">
                    {{-- <img src="assets/img/banner/regi-1.png" alt=""> --}}
                    <div class="winter-content">
                        <span>NIIT </span>
                        <h3>{{ date('Y') }}</h3>
                        <span>SCHOLARSHIP </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-md-8 pull-right">
                    <div class="register-form">
                        @if (session('success'))
                            <div class="alert alert-success text-center page_alert">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true"> ×</span></button>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->count() != 0)
                            <div class="alert alert-danger text-center page_alert">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true"> ×</span></button>
                                You have some errors in your registration!
                            </div>
                        @endif

                        <h4>Registration is free</h4>
                        <form action="{{ route('scholarship_attendee.store') }}" method="POST">
                            @csrf()

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="contact-form-style mb-20">
                                        <input name="first_name" placeholder="First Name" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact-form-style mb-20">
                                        <input name="last_name" placeholder="Last Name" type="text">
                                    </div>
                                </div>
                                <input type="hidden" name="scholarship_id" value="{{ $activeScholarship->uid }}">
                                <div class="col-lg-6">
                                    <div class="contact-form-style mb-20">
                                        <input name="phone" placeholder="Phone" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact-form-style mb-20">
                                        <input name="email" placeholder="Email" type="text">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="contact-form-style mb-20">
                                        <select name="preferred_exam_time">
                                            <option>Select preferred exam time</option>
                                            @foreach ($examTimes as $examTime)
                                                <option value="{{ $examTime }}">{{ $examTime }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact-form-style mb-20">
                                        <select name="school_level">
                                            <option>Select current status</option>
                                            @foreach ($levels as $level)
                                                <option value="{{ $level }}">{{ $level }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="contact-form-style">
                                        <button class="submit default-btn" type="submit">SUBMIT NOW</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="register-1" class="mouse-bg" style="left: -2.99805%; right: -2.99805%; top: -10.9281%; bottom: -10.9281%; z-index: 1;"></div>
    <div id="register-2" class="mouse-bg" style="left: -2.99805%; right: -2.99805%; top: -10.9281%; bottom: -10.9281%; z-index: 1;"></div>
</div>