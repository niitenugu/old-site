@extends('admin.layouts.app')

@section('page_title', '| Edit Attendee')

@section('content')
<div class="content-w space_main_content">

  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('admin.events.index') }}">Events</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('admin.attendees.index', $event->uid) }}">Attendees</a>
    </li>
    <li class="breadcrumb-item">
      <span>Edit Attendee</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">
      
      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.attendees.index', $event->uid) }}">
            <span>Go back to list</span>
          </a>
        </div>
        <h6 class="element-header">
          Register Attendee
        </h6>
        <div class="element-box">

          <form action="{{ route('admin.attendees.update', [$event->uid, $attendee->uid]) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('PUT')

          <h5 class="form-header">
            Attendee Form
          </h5>
          <hr class="mb-5">
          
          @include('admin.partials.alert')

          <div class="form-group">
            <label for="event-title"> Event Title:</label>
            <input class="form-control" type="text" value="{{ $event->title }}" id="event-title" readonly>
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

          <div class="form-group">
            <label for="gender"> Gender:</label>
            <select class="form-control" name="gender" id="gender">
              <option value="">Select gender</option>
              <option value="Male" {{ ($attendee->gender == 'Male') || old('gender') ? 'selected' : '' }}>Male</option>
              <option value="Female" {{ ($attendee->gender == 'Female') || old('gender') ? 'selected' : '' }}>Female</option>
            </select>
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
