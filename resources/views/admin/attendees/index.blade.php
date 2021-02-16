@extends('admin.layouts.app')

@section('page_title', '| Attendees')

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
      <span>Attendees</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">
      
      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.events.index') }}">
            <span>Go back</span>
          </a>

          <a class="btn btn-primary btn-sm" href="{{ route('admin.attendees.create', $event->uid) }}">
            <i class="os-icon os-icon-ui-22"></i><span>Register Attendeee</span>
          </a>
        </div>
        <h6 class="element-header">
          Attendees
        </h6>
        <div class="borderless text-muted" style="padding: 20px;background-color: #FBF9F3;font-size: 0.81rem;margin: 20px 0px;">
          <strong>EVENT TITLE: {{ strtoupper($event->title) }}</strong>
        </div>
        <div class="element-box">

          @include('admin.partials.alert')

          <div class="controls-above-table">
            <div class="row">
              <div class="col-sm-6">
                {{-- <a class="btn btn-sm btn-secondary" href="#">Download CSV</a> --}}
                {{-- <a class="btn btn-sm btn-secondary" href="#">Archive</a>
                <a class="btn btn-sm btn-danger" href="#">Delete</a> --}}
              </div>
              {{-- <div class="col-sm-6">
                <form class="form-inline justify-content-sm-end">
                  <input class="form-control form-control-sm rounded bright" placeholder="Search" type="text"><select class="form-control form-control-sm rounded bright">
                    <option selected="selected" value="">
                      Select Status
                    </option>
                    <option value="Pending">
                      Pending
                    </option>
                    <option value="Active">
                      Active
                    </option>
                    <option value="Cancelled">
                      Cancelled
                    </option>
                  </select>
                </form>
              </div> --}}
            </div>
          </div>

          <div class="table-responsive">
          <table class="table table-lightborder table-striped table-hover">
            <thead>
              <tr>
                <th width="20%">{{ __('Full Name') }}</th>
                <th width="15%">{{ __('Invitation Code') }}</th>
                <th width="23%">{{ __('Contact') }}</th>
                <th width="24%">{{ __('Check-in Status') }}</th>
                @can ('isAdminGroup')
                  <th width="18%">&nbsp;</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @forelse ($attendees->chunk(10) as $chunk)
                @foreach ($chunk as $attendee)
                  <tr>
                    <td>
                      {{ $attendee->fullname }} <br>
                      <small class="text-muted" style="text-transform: uppercase;">{{ $attendee->gender }}</small>
                    </td>
                    <td>
                      <code>{{ $attendee->invitation_code }}</code>
                    </td>
                    <td>
                      {{ $attendee->email }}
                      <div>{{ $attendee->phone }}</div>
                    </td>
                    <td>
                      <div class="badge {{ $attendee->checked_in_at == '' ? ' badge-primary-inverted' : 'badge-success-inverted' }}">
                        {{ $attendee->checked_in_at == '' ? "Not checked-in" : "Checked-in " . $attendee->checked_in_at->diffForHumans() }}
                      </div> <br>
                      @if ($attendee->checked_in_at)
                        <small style="text-transform: uppercase;">{{ $attendee->checked_in_at->format('d F, Y @ h:ia') }}</small>
                      @endif
                    </td>
                    @can ('isAdminGroup')
                      <td>
                        <div class="btn-group mr-1 mb-1">
                          <button aria-expanded="false" aria-haspopup="true" class="btn btn-grey dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton6" type="button">Actions</button>
                          <div aria-labelledby="dropdownMenuButton6" class="dropdown-menu">
                            
                            @if (! $attendee->checked_in_at)
                              <a class="dropdown-item text-primary" onclick="confirm('{{ __("Are you sure you want to proceed?") }}') ? document.getElementById('status-{{$attendee->uid}}').submit() : ''" href="javascript:;"> {{ __('Check-in Attendee') }}</a>
                            @else
                              <a class="dropdown-item text-danger" onclick="confirm('{{ __("Are you sure you want to reverse action?") }}') ? document.getElementById('status-{{$attendee->uid}}').submit() : ''" href="javascript:;"> {{ __('Reverse Check-in') }}</a>
                            @endif

                            <form id="status-{{$attendee->uid}}" action="{{ route('admin.attendees.post_checkin', [$event->uid, $attendee->uid]) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                              <input type="hidden" value="{{ $attendee->checked_in_at }}" name="checked_in_at">
                            </form>
                            
                            <hr>

                            <a class="dropdown-item" href="{{ route('admin.attendees.edit', [$event->uid, $attendee->uid]) }}"> {{ __('Edit') }}</a>

                            <a class="dropdown-item" href="#"> {{ __('View Details') }}</a>
                            
                            <a class="dropdown-item text-danger" href="javascript:;" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? document.getElementById('delete-{{$attendee->uid}}').submit() : ''"> {{ __('Delete') }}</a>

                            <form id="delete-{{$attendee->uid}}" action="{{ route('admin.attendees.destroy', $attendee->uid) }}" method="POST" style="display: none;">
                              @csrf
                              @method('DELETE')
                          </form>
                          </div>
                        </div>
                      </td>
                    @endcan
                  </tr>
                @endforeach

                @if ($loop->remaining === 0)
                  <tr style="background-color:#ced2db; text-transform: uppercase;">
                    <td colspan="5" class="p-3 text-center uppercase">
                      <small>Showing {{ $attendees->firstItem() }} to {{ $attendees->lastItem() }} of 
                      {{ $attendees->total() }} records</small>
                    </td>
                  </tr>
                @endif

              @empty
                <tr>
                  <td colspan="5" class="text-center">No record found!</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <div class="mt-4">
            {{ $attendees->links() }}
          </div>

        </div>

        </div>
      </div>
     
    </div>
  </div>
</div>

@endsection
