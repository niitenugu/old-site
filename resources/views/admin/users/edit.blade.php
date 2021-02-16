@extends('admin.layouts.app')

@section('page_title', '| Edit User')

@section('content')
<div class="content-w space_main_content">

  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('admin.users.index') }}">Users</a>
    </li>
    <li class="breadcrumb-item">
      <span>Edit User</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">
      
      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.users.index') }}">
            <span>Go back to list</span>
          </a>
        </div>
        <h6 class="element-header">
          Edit User
        </h6>
        <div class="element-box">

          <form action="{{ route('admin.users.update', $user->uid) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('PUT')

          <h5 class="form-header">
            User Form
          </h5>
          <hr class="mb-5">
          
          @include('admin.partials.alert')

          <div class="form-group">
            <label for="user-name"> Full Name: *</label>
            <input class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter full name" type="text" value="{{ old('name') ?? $user->name }}" id="user-name">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="email"> Email: *</label>
                <input class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" type="email" value="{{ old('email') ?? $user->email }}" id="email">
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
                <input class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone number" value="{{ old('phone') ?? $user->phone }}" type="text" id="phone" maxlength="14">
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
                <label for="role"> Role: *</label>
                <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
                  <option value="">Select roles</option>
                  @foreach ($roles as $role => $displayName)
                  <option value="{{ $role }}" {{ $role == old('role') || $role == $user->role ? 'selected' : '' }}>
                    {{ $displayName }}
                  </option>
                  @endforeach
                </select>
                @error('role')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="status">{{ __('Status: *') }}</label>
                <select class="form-control @error('is_active') is-invalid @enderror" name="is_active" id="status">
                  <option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}>Active</option>
                  <option value="0" {{ $user->is_active == 0 ? 'selected' : '' }}>Deactive</option>
                </select>
                @error('is_active')
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
