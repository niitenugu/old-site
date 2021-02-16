@extends('admin.layouts.app')

@section('page_title', '| Edit Scholarship Attendee')

@section('content')
<div class="content-w space_main_content">

  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('admin.scholarships.index') }}">Scholarships</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('admin.scholarship_attendees.index', $scholarship->uid) }}">Scholarship Attendees</a>
    </li>
    <li class="breadcrumb-item">
      <span>Edit Scholarship Attendee</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">
      
      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.scholarship_attendees.index', $scholarship->uid) }}">
            <span>Go back to list</span>
          </a>
        </div>
        <h6 class="element-header">
          Register Scholarship Attendee
        </h6>
        <div class="element-box">

          <form action="{{ route('admin.scholarship_attendees.update', [$scholarship->uid, $attendee->uid]) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('PUT')

          <h5 class="form-header">
            Scholarship Attendee Form
          </h5>
          <hr class="mb-5">
          
          @include('admin.partials.alert')

          <div class="form-group">
            <label for="scholarship-title"> Scholarship Title:</label>
            <input class="form-control" type="text" value="{{ $scholarship->title }}" id="scholarship-title" readonly>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="first-name"> First Name: *</label>
                <input class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="Enter first name" type="text" value="{{ old('first_name') ?? $attendee->first_name }}" id="first-name" maxlength="50">
                @error('first_name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="last-name">{{ __('Last Name: *') }}</label>
                <input class="form-control @error('last_first') is-invalid @enderror" name="last_name" placeholder="Enter last name" value="{{ old('last_first') ?? $attendee->last_name }}" type="text" id="last-name" maxlength="50">
                @error('last_first')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="email"> Email: *</label>
                <input class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" type="email" value="{{ old('email') ?? $attendee->email }}" id="email">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="phone">{{ __('Phone') }}</label>
                <input class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone number" value="{{ old('phone') ?? $attendee->phone }}" type="text" id="phone" maxlength="14">
                @error('phone')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="email"> {{ __('Preferred Exam Time *') }}</label>
                <select class="form-control @error('preferred_exam_time') is-invalid @enderror" name="preferred_exam_time" id="preferred_exam_time">
                  <option value="">Select preferred exam time</option>
                  @foreach ($examTimes as $examTime)
                    <option value="{{ $examTime }}" {{ $attendee->preferred_exam_time == $examTime ? 'selected' : '' }}>{{ $examTime }}</option>
                  @endforeach
                </select>
                @error('preferred_exam_time')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="phone">{{ __('School Level *') }}</label>
                <select class="form-control @error('school_level') is-invalid @enderror" name="school_level" id="school_level">
                  <option value="">Select school level</option>
                  @foreach ($levels as $level)
                    <option value="{{ $level }}" {{ $attendee->school_level == $level ? 'selected' : '' }}>{{ $level }}</option>
                  @endforeach
                </select>
                @error('school_level')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="form-buttons-w">
            <button class="btn btn-primary" type="submit"> Submit</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('custom_js')
<script type="text/javascript" src="{{ asset('admin_assets/bower_components/summernote/summernote-bs4.min.js') }}"></script>

<script>
  $(function(){
    'use strict';

    // Summernote editor
    $('#summernote').summernote({
      height: 240,
      tooltip: false
    })
  });
</script>
<script src="{{ asset('admin_assets/bower_components/moment/moment.js') }}"></script>
<script src="{{ asset('admin_assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

@endsection
