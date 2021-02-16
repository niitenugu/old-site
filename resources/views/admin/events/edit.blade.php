@extends('admin.layouts.app')

@section('page_title', '| Edit Event')

@section('custom_css')
<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/bower_components/summernote/summernote-bs4.css') }}">
@endsection

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
      <span>Edit Event</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">
      
      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.events.index') }}">
            <span>Go back to list</span>
          </a>
        </div>
        <h6 class="element-header">
          Edit Event
        </h6>
        <div class="element-box">

          <form action="{{ route('admin.events.update', $event->uid) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('PUT')

          <h5 class="form-header">
            Event Form
          </h5>
          <hr class="mb-5">
          
          @include('admin.partials.alert')

          <div class="form-group">
            <label for="event-title"> Event Title: *</label>
            <input class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter event title" type="text" value="{{ old('title') ?? $event->title }}" id="event-title">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="details"> Details: *</label>
            <textarea class="form-control @error('details') is-invalid @enderror" name="details" id="summernote">{{ old('details') ?? $event->details }}</textarea>
            @error('details')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="event-date"> Event Date <i>(Starts and Ends)</i> : *</label>
            <input class="custom-daterange form-control @error('event_date') is-invalid @enderror" name="event_date" placeholder="Event Date" type="text" value="{{ old('event_date') ?? $event->start_date->format('Y-m-d') . ' to ' . $event->end_date->format('Y-m-d') }}" id="event-date">
            @error('event_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="event-time"> Event Time: </label>
            <input class="form-control" name="time" placeholder="Select event time" type="time" value="{{ old('time') ?? $event->time }}" id="event-time">
          </div>

          <div class="form-group">
            <label for="event-venue"> Event Venue:</label>
            <input class="form-control @error('venue') is-invalid @enderror" name="venue" placeholder="Enter venue of the event" type="text" value="{{ old('venue') ?? $event->venue }}" id="event-venue">
            @error('venue')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="registration-date"> Registration Date <i>(if any registration required)</i> :</label>
            <input class="custom-daterange form-control" name="registration_date" placeholder="Registration Date" type="text" value="{{ old('registration_date') ?? ! is_null($event->registration_start_date) ? $event->registration_start_date->format('Y-m-d') . ' to ' . $event->registration_start_date->format('Y-m-d') : '' }}" id="registration-date">
          </div>

          <div class="form-group">
            <label for="photo"> Cover Photo <i>(Max: 800Kb)</i> </label>
            <input class="form-control @error('photo') is-invalid @enderror" name="photo" placeholder="Select course cover photo" type="file" value="{{ old('photo') }}" id="photo">
            @error('photo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" name="is_live" {{ old('is_live') ?? $event->is_live ? 'checked' : '' }} type="checkbox"> Make this event visible on the website
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
