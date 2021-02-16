@extends('admin.layouts.app')

@section('page_title', '| Check-in Attendee')

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
      <span>Check-in Attendee</span>
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
          Check-in Attendee
        </h6>

        <div class="element-box">
          <h5 class="form-header">
            Event: {{ $event->title }}
          </h5>

          @include('admin.partials.alert')

          <div class="form-desc" style="color:#333;">
            Check-in attendees for this event. Search for an attendee on the invite list using any of the 
            following; their <u>invitation code,</u> <u>email</u>, or <u>phone number</u>. <br>
            <em>We strongly recommend you use their <u>invitation code.</u></em>
          </div>
          <form class="form-inline" {{ route('admin.attendees.checkin', $event->uid) }} method="GET">
            <label class="sr-only"> Search phrase</label>
            <input class="form-control mb-2 mr-sm-2 mb-sm-0 col-sm-10" name="search" placeholder="Invitation code / email / phone number" type="text" value="{{ request()->query('search') }}" minlength="2">
            <button class="btn btn-primary col-sm-1" type="submit"> Search</button>
          </form>
        </div>

        @if (request()->query('search'))
          <h5 class="form-header">
            Search Result @if ($attendees->count() > 0) ({{ $attendees->count() }} found!) @endif
          </h5>

          <div class="element-box-tp">
            @forelse ($attendees as $attendee)

              <div class="post-box">
                <div class="post-content">
                  <h6 class="post-title" style="margin-bottom: 13px;">
                    {{ $attendee->fullname }}
                    <span class="btn btn-grey btn-sm" style="font-size:14px;margin-left:10px;background-color: #f3f3f7;border-color: #f3f3f7;cursor:text;"><code>{{ $attendee->invitation_code }}</code></span>
                  </h6>
                  <div class="post-text" style="font-size: 14px;">
                    {{ $attendee->gender }} &nbsp; | &nbsp; 
                    {{ $attendee->phone }} &nbsp; | &nbsp; 
                    {{ $attendee->email }}
                  </div>
                  <hr>
                  <div class="post-foot">
                    <div class="post-tags">
                      <div class="badge {{ $attendee->checked_in_at == '' ? ' badge-primary-inverted' : 'badge-success-inverted' }}">
                        {{ $attendee->checked_in_at == '' ? "Not checked-in" : "Checked-in " . $attendee->checked_in_at->diffForHumans() }}
                      </div> &nbsp;
                      @if ($attendee->checked_in_at)
                        <span data-container="body" data-content="{{ $attendee->checked_in_at->format('d F, Y @ h:ia') }}" data-placement="top" data-toggle="popover" title="" data-original-title="Checked-in At"><i class="os-icon os-icon-info"></i></span>
                      @endif
                    </div>

                    @if (! $attendee->checked_in_at)
                      <a class="post-link" onclick="confirm('{{ __("Are you sure you want to proceed?") }}') ? document.getElementById('status-{{$attendee->uid}}').submit() : ''" href="javascript:;"><span>Check-in Attendee</span><i class="os-icon os-icon-arrow-right7"></i></a>
                    @else
                      <a class="post-link text-danger" onclick="confirm('{{ __("Are you sure you want to reverse action?") }}') ? document.getElementById('status-{{$attendee->uid}}').submit() : ''" href="javascript:;"><span>Reverse Check-in</span><i class="os-icon os-icon-arrow-right7"></i></a>
                    @endif

                    <form id="status-{{$attendee->uid}}" action="{{ route('admin.attendees.post_checkin', [$event->uid, $attendee->uid]) }}" method="POST" style="display: none;">
                      @csrf
                      @method('PUT')
                      <input type="hidden" value="{{ $attendee->checked_in_at }}" name="checked_in_at">
                    </form>
                  </div>
                </div>
              </div>
            @empty
              <div class="post-box alert alert-primary">
                <div class="post-content text-center">
                  <h6>This attendee was not found!</h6>
                  <a href="{{ route('admin.attendees.create', $event->uid) }}"><u>You can register attendee instead</u></a>
                </div>
              </div>
            @endforelse
            
          </div>
        @endif
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
