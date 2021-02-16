<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>{{ config('app.name', 'NIIT Enugu') }} @yield('page_title')</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="NIIT" name="keywords">
    <meta content="{{ config('app.name') }}" name="author">
    <meta content="" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    {{-- <link href="favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon"> --}}
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_assets/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/bower_components/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/bower_components/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/bower_components/slick-carousel/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/main.css?version=1.0.0') }}" rel="stylesheet">
  </head>
  <body>
    <div class="all-wrapper menu-side with-pattern">
      <div class="auth-box-w wider">
        <div class="logo-w">
          <a href="index.html"><img alt="" src="img/logo-big.png"></a>
        </div>
        <h4 class="auth-header">
          Create new account
        </h4>
        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="form-group">
            <label for=""> Full name</label>
            <input class="form-control" name="name" value="{{ old('name') }}"  placeholder="Enter full name" type="text">
            <div class="pre-icon os-icon os-icon-user"></div>
          </div>

          <div class="form-group">
            <label for=""> Email address</label>
            <input class="form-control" name="email" value="{{ old('email') }}"  placeholder="Enter email" type="email">
            <div class="pre-icon os-icon os-icon-email-2-at2"></div>
          </div>

          <div class="form-group">
            <label for=""> Role</label>
            <select class="form-control" name="role">
              <option value="owner">Developer</option>
              <option value="superadmin">Director</option>
              <option value="admin">Center Head</option>
              <option value="staff">Staff</option>
            </select>
            <div class="pre-icon os-icon os-icon-email-2-at2"></div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="password"> Password</label>
                <input class="form-control" name="password" placeholder="Password" type="password" id="password">
                <div class="pre-icon os-icon os-icon-fingerprint"></div>

              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input class="form-control" name="password_confirmation" placeholder="Password" type="password" id="password-confirm" autocomplete="new-password">
              </div>
            </div>
          </div>
          <div class="buttons-w">
            <button class="btn btn-primary">Register Now</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
