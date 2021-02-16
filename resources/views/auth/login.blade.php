<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>{{ config('app.name', 'NIIT Enugu') }} | Admin Login</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="NIIT" name="keywords">
    <meta content="{{ config('app.name') }}" name="author">
    <meta content="" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="{{ asset('assets/img/icon.png') }}" rel="shortcut icon">
    {{-- <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('admin_assets/css/main.css?version=1.0.0') }}" rel="stylesheet">
    <style type="text/css">
      .logo_font { font-size:25px;font-weight:700;  }
      .logo_font:hover { text-decoration: none;  }
    </style>
  </head>
  <body>
    <div class="all-wrapper menu-side with-pattern">
      <div class="auth-box-w wider">
        <div class="logo-w">
          <a class="logo_font" href="{{ route('homepage') }}">
            NIIT ENUGU
            {{-- <img alt="" src="{{ asset('admin_assets/img/logo-big.png') }}"> --}}
          </a>
        </div>
        <h4 class="auth-header">
          Login Form
        </h4>
        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="form-group">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter your email" value="{{ old('email') }}" type="email" id="email" autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="pre-icon os-icon os-icon-email-2-at2"></div>
          </div>

          <div class="form-group">
            <label for="password" style="display: block;">
              <span style="display: inline-block;float: left">{{ __('Password') }}</span>
              <small style="display: inline-block; float: right"><a href="{{ route('password.request') }}">Forgot password?</a></small>
            </label>
            <input class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter your password" type="password" autocomplete="current-password" id="password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="pre-icon os-icon os-icon-fingerprint"></div>
          </div>
          <div class="buttons-w">
            <button class="btn btn-primary">Log me in</button>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>Remember Me
              </label>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
