@extends('admin.layouts.app')

@section('page_title', '| Edit Scholarship')

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
      <a href="{{ route('admin.scholarships.index') }}">Scholarships</a>
    </li>
    <li class="breadcrumb-item">
      <span>Edit Scholarship</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">
      
      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.scholarships.index') }}">
            <span>Go back to list</span>
          </a>
        </div>
        <h6 class="element-header">
          Edit Scholarship
        </h6>
        <div class="element-box">

          <form action="{{ route('admin.scholarships.update', $scholarship->uid) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('PUT')

          <h5 class="form-header">
            Scholarship Form
          </h5>
          <hr class="mb-5">
          
          @include('admin.partials.alert')

          <div class="form-group">
            <label for="scholarship-title"> Scholarship Title: *</label>
            <input class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter scholarship title" type="text" value="{{ old('title') ?? $scholarship->title }}" id="scholarship-title">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="details"> Details: *</label>
            <textarea class="form-control @error('details') is-invalid @enderror" name="details" id="summernote">{{ old('details') ?? $scholarship->details }}</textarea>
            @error('details')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="scholarship-date"> Scholarship Date <i>(Starts and Ends)</i> : *</label>
            <input class="custom-daterange form-control @error('event_date') is-invalid @enderror" name="event_date" placeholder="Scholarship Date" type="text" value="{{ old('event_date') ?? $scholarship->start_date->format('Y-m-d') . ' to ' . $scholarship->end_date->format('Y-m-d') }}" id="scholarship-date">
            @error('event_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="scholarship-time"> Scholarship Time: </label>
            <input class="form-control" name="time" placeholder="Select scholarship time" type="time" value="{{ old('time') ?? $scholarship->time }}" id="scholarship-time">
          </div>

          <div class="form-group">
            <label for="scholarship-venue"> Scholarship Venue:</label>
            <input class="form-control @error('venue') is-invalid @enderror" name="venue" placeholder="Enter venue of the scholarship" type="text" value="{{ old('venue') ?? $scholarship->venue }}" id="scholarship-venue">
            @error('venue')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="registration-date"> Registration Date <i>(if any registration required)</i> :</label>
            <input class="custom-daterange form-control" name="registration_date" placeholder="Registration Date" type="text" value="{{ old('registration_date') ?? ! is_null($scholarship->registration_start_date) ? $scholarship->registration_start_date->format('Y-m-d') . ' to ' . $scholarship->registration_start_date->format('Y-m-d') : '' }}" id="registration-date">
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
              <input class="form-check-input" name="is_live" {{ old('is_live') ?? $scholarship->is_live ? 'checked' : '' }} type="checkbox"> Make this scholarship visible on the website
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
