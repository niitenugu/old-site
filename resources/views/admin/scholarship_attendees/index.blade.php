@extends('admin.layouts.app')

@section('page_title', '| Scholarship Attendees')

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
      <span>Scholarship Attendees</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">
      
      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.scholarships.index') }}">
            <span>Go back</span>
          </a>

          <a class="btn btn-primary btn-sm" href="{{ route('admin.scholarship_attendees.create', $scholarship->uid) }}">
            <i class="os-icon os-icon-ui-22"></i><span>Register Attendeee</span>
          </a>
        </div>
        <h6 class="element-header">
          Scholarship Attendees
        </h6>
        {{-- <div class="borderless text-muted" style="padding: 20px;background-color: #FBF9F3;font-size: 0.81rem;margin: 20px 0px;">
          <strong>TITLE: {{ strtoupper($scholarship->title) }}</strong>
        </div> --}}

        <div class="element-contentz alert alert-primary" style="background-color: white;">
          <strong>{{ $scholarship->title }}</strong>
        </div>


        <div class="element-content">
          <div class="row">
            <div class="col-sm-4 col-xxxl-3">
              <a class="element-box el-tablo" href="#">
                <div class="label">
                  Total Registration
                </div>
                <div class="value">
                  {{ $totalAttendees }}
                </div>
              </a>
            </div>
            <div class="col-sm-4 col-xxxl-3">
              <a class="element-box el-tablo" href="#">
                <div class="label">
                  Total Present
                  <span data-placement="top" data-toggle="tooltip" title="" data-original-title="Total number of people that attended (i.e checked-in to) the scholarship"><i class="os-icon os-icon-info text-info"></i></span>
                </div>
                <div class="value">
                  {{ $totalPresent }}
                </div>
              </a>
            </div>
            <div class="col-sm-4 col-xxxl-3">
              <a class="element-box el-tablo" href="#">
                <div class="label">
                  Total Absentees
                  <span data-placement="top" data-toggle="tooltip" title="" data-original-title="Total number of people that did not attend (i.e checked-in to) the scholarship"><i class="os-icon os-icon-info text-info"></i></span>
                </div>
                <div class="value">
                  {{ $totalAbsent }}
                </div>
              </a>
            </div>
          </div>
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
                <th width="15%">{{ __('Preferred Exam Time') }}</th>
                <th width="20%">{{ __('Contact') }}</th>
                <th width="18%">{{ __('Check-in Status') }}</th>
                <th width="12%">{{ __('Registered On') }}</th>
                @can ('isAdminGroup')
                  <th width="15%">&nbsp;</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @forelse ($attendees->chunk(10) as $chunk)
                @foreach ($chunk as $attendee)
                  <tr>
                    <td>
                      {{ $attendee->fullname }} <br>
                      <code>{{ $attendee->invitation_code }}</code>
                    </td>
                    <td>
                      {{ $attendee->preferred_exam_time }}
                    </td>
                    <td>
                      {{ $attendee->email }}
                      <div>{{ $attendee->phone }}</div>
                    </td>
                    <td>
                      <div class="badge {{ $attendee->checked_in_at == '' ? ' badge-warning' : 'badge-info' }} mb-2">
                        {{ $attendee->checked_in_at == '' ? "Not checked-in" : "Checked-in" }}
                      </div>
                      @if ($attendee->checked_in_at)
                        <span data-container="body" data-content="{{ $attendee->checked_in_at->format('d F, Y @ h:ia') }}" data-placement="top" data-toggle="popover" title="" data-original-title="Checked-in At"><i class="os-icon os-icon-info text-info"></i></span>
                      @endif

                      <div>
                        @if (! $attendee->checked_in_at)
                          <a onclick="confirm('{{ __("Are you sure you want to proceed?") }}') ? document.getElementById('status-{{$attendee->uid}}').submit() : ''" href="javascript:;" style="text-decoration:underline;font-size:14px;color:#3E4B5B;font-weight:700;"> {{ __('Check-in Attendee') }}</a>
                        @else
                          <a onclick="confirm('{{ __("Are you sure you want to undo check-in?") }}') ? document.getElementById('status-{{$attendee->uid}}').submit() : ''" href="javascript:;" style="text-decoration:underline;font-size:14px;color:#3E4B5B;font-weight:700;"> {{ __('Undo Check-in') }}</a>
                        @endif

                        <form id="status-{{$attendee->uid}}" action="{{ route('admin.scholarship_attendees.post_checkin', [$scholarship->uid, $attendee->uid]) }}" method="POST" style="display: none;">
                          @csrf
                          @method('PUT')
                          <input type="hidden" value="{{ $attendee->checked_in_at }}" name="checked_in_at">
                        </form>
                      </div>
                    </td>

                    <td>
                      {{ $attendee->created_at->format('d M, Y') }}
                      <div>{{ $attendee->created_at->format('@ h:ia') }}</div>
                    </td>

                    @can ('isAdminGroup')
                      <td>
                        <div class="btn-group mr-1 mb-1">
                          <button aria-expanded="false" aria-haspopup="true" class="btn btn-grey dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton6" type="button">Actions</button>
                          <div aria-labelledby="dropdownMenuButton6" class="dropdown-menu">
                           
                            <a class="dropdown-item" href="{{ route('admin.scholarship_attendees.edit', [$scholarship->uid, $attendee->uid]) }}"> {{ __('Edit') }}</a>

                            <a class="dropdown-item" href="#"> {{ __('View Details') }}</a>
                            
                            <a class="dropdown-item text-danger" href="javascript:;" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? document.getElementById('delete-{{$attendee->uid}}').submit() : ''"> {{ __('Delete') }}</a>

                            <form id="delete-{{$attendee->uid}}" action="{{ route('admin.scholarship_attendees.destroy', $attendee->uid) }}" method="POST" style="display: none;">
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
                    <td colspan="6" class="p-3 text-center uppercase">
                      <small>Showing {{ $attendees->firstItem() }} to {{ $attendees->lastItem() }} of 
                      {{ $attendees->total() }} records</small>
                    </td>
                  </tr>
                @endif

              @empty
                <tr>
                  <td colspan="6" class="text-center">No record found!</td>
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
