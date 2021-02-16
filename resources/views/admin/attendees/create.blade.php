@extends('admin.layouts.app')

@section('page_title', '| Register Attendee')

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
      <span>Register Attendee</span>
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

          <form action="{{ route('admin.attendees.store', $event->uid) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf

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
                <input class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="Enter first name" type="text" value="{{ old('first_name') }}" id="first-name" maxlength="50" required>
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
                <input class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="Enter last name" value="{{ old('last_name') }}" type="text" id="last-name" maxlength="50" required>
                @error('last_name')
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
                <input class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" type="email" value="{{ old('email') }}" id="email" required>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="phone">{{ __('Phone *') }}</label>
                <input class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone number" value="{{ old('phone') }}" type="text" id="phone" maxlength="14" required>
                @error('phone')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="gender"> Gender: *</label>
            <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" required>
              <option value="">Select gender</option>
              <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
              <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group row">
            <label class="col-12 col-form-label">
              <strong>Do you want to check-in this attendee into the event now?</strong>
            </label>
            <div class="col-12">
              <div class="form-check">
                <label class="form-check-label"><input {{ old('checked_in_at') == 'yes' ? 'checked' : '' }} class="form-check-input" name="checked_in_at" type="radio" value="yes">Yes, check-in now</label>
              </div>
              <div class="form-check">
                <label class="form-check-label"><input {{ old('checked_in_at') == 'no' ? 'checked' : '' }} class="form-check-input" name="checked_in_at" type="radio" value="no">No, maybe later during the event</label>
              </div>
            </div>
          </div>

          <br><br>

          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" name="send_invitation_code" {{ old('send_invitation_code') ? 'checked' : '' }} type="checkbox"> <strong>Send invitation code to attendee? <em>(This is optional if registration is been done right in the event.)</em></strong>
            </label>
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
