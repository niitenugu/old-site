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
    <link rel="shortcut icon" href="{{ asset('assets/img/icon.png') }}">
    {{-- <link href="favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('admin_assets/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/bower_components/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/bower_components/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/bower_components/slick-carousel/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/main.css?version=1.0.0') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/custom.css?version=1.0.0') }}" rel="stylesheet">

    @yield('custom_css')

  </head>
  <body class="menu-position-side menu-side-left full-screen"> {{-- Add: color-scheme-dark --}}
    <div class="all-wrapper solid-bg-all">