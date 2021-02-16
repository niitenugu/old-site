@extends('admin.layouts.app')

@section('page_title', '| Create Course')

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
      <a href="{{ route('admin.courses.index') }}">Courses</a>
    </li>
    <li class="breadcrumb-item">
      <span>Create Course</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">
      
      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.courses.index') }}">
            <span>Go back to list</span>
          </a>
        </div>
        <h6 class="element-header">
          Create Course
        </h6>
        <div class="element-box">

          <form action="{{ route('admin.courses.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf

          <h5 class="form-header">
            Course Form
          </h5>
          <hr class="mb-5">
          
          @include('admin.partials.alert')

          <div class="form-group">
            <label for="category"> Course Category: *</label>
            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category">
              <option value="">Select course category</option>
              @foreach ($categories as $category)
                <option value="{{ $category->uid }}" {{ old('category_id') == $category->uid ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
            @error('category_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="course-title"> Course Title: *</label>
            <input class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter course title" type="text" value="{{ old('title') }}" id="course-title">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="details"> Details: *</label>
            <textarea class="form-control @error('details') is-invalid @enderror" name="details" id="summernote">{{ old('details') }}</textarea>
            @error('details')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="course-duration"> Course Duration <i>(in months)</i> : *</label>
            <input class="form-control @error('duration') is-invalid @enderror" name="duration" placeholder="Enter course duration" type="number" min="1" value="{{ old('duration') }}" id="course-duration">
            @error('duration')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="course-cost"> Course Cost <i>(in naira)</i> :</label>
                <input class="form-control @error('cost') is-invalid @enderror" name="cost" placeholder="Enter course cost" type="text" value="{{ old('cost') }}" id="course-cost">
                @error('cost')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="discount"> Discount <i>(in %)</i> :</label>
                <input class="form-control @error('discount') is-invalid @enderror" name="discount" placeholder="Enter discount (if any)" type="text" value="{{ old('discount') }}" id="discount">
                @error('discount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
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
              <input class="form-check-input" name="is_live" {{ old('is_live') ? 'checked' : '' }} type="checkbox"> Make category visible on the website
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

@endsection
