@extends('admin.layouts.app')

@section('page_title', '| Edit Job')

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
      <a href="{{ route('admin.jobs.index') }}">Jobs</a>
    </li>
    <li class="breadcrumb-item">
      <span>Edit Job</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">

      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.jobs.index') }}">
            <span>Go back to list</span>
          </a>
        </div>
        <h6 class="element-header">
          Edit Job
        </h6>
        <div class="element-box">

          <form action="{{ route('admin.jobs.update', $job->uid) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('PUT')

          <h5 class="form-header">
            Job Form
          </h5>
          <hr class="mb-5">

          @include('admin.partials.alert')

          <div class="form-group">
            <label for="event-title"> Job Title: *</label>
            <input class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter event title" type="text" value="{{ old('title') ?? $job->title }}" id="event-title" required>
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="details"> Job Details: *</label>
            <textarea class="form-control @error('details') is-invalid @enderror" name="details" id="summernote">{{ old('details') ?? $job->details }}</textarea>
            @error('details')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="opening-date"> Job Opening and Closing Date:</label>
            <input class="custom-daterange form-control" name="opening_date" placeholder="Job Opening and Closing Date" type="text" value="{{ old('opening_date') ?? ! is_null($job->opening_start_date) ? $job->opening_start_date->format('Y-m-d') . ' to ' . $job->opening_start_date->format('Y-m-d') : '' }}" id="opening-date">
          </div>

          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" name="is_live" {{ old('is_live') ?? $job->is_live ? 'checked' : '' }} type="checkbox"> Make this job visible on the website
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
