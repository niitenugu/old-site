@extends('admin.layouts.app')

@section('page_title', '| Scholarships')

@section('content')
<div class="content-w space_main_content">
  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <span>Scholarships</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">
      
      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.scholarships.create') }}">
            <i class="os-icon os-icon-ui-22"></i><span>Add Scholarship</span>
          </a>
        </div>
        <h6 class="element-header">
          Scholarships
        </h6>
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
                <th width="37%">{{ __('Title') }}</th>
                <th width="15%">{{ __('Attendees') }}</th>
                <th width="18%">{{ __('Registration') }}</th>
                <th width="15%">{{ __('Status') }}</th>
                <th width="15%">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($scholarships->chunk(10) as $chunk)
                @foreach ($chunk as $scholarship)
                  <tr>
                    <td>
                      {{ $scholarship->title }}
                      <div class="text-muted">
                        <small>{{ strtoupper($scholarship->eventDate) }}</small>
                      </div>
                    </td>
                    <td>
                      {{ $count = $scholarship->attendees->count() }}
                      {{ str_plural('attendee', $count) }} 

                      @if ($count > 0)
                        <div>
                          <small><a href="{{ route('admin.scholarship_attendees.index', $scholarship->uid) }}" style="text-decoration:underline;font-size:11px;">VIEW ATTENDEES</a></small>
                        </div>
                        @else
                          <div>
                            <small><a href="{{ route('admin.scholarship_attendees.create', $scholarship->uid) }}" style="text-decoration:underline;font-size:11px;">ADD ATTENDEES</a></small>
                          </div>
                        @endif
                    </td>
                    <td>
                      @if (! is_null($scholarship->registration_start_date))
                        <div>
                          <small>
                            {{ is_null($scholarship->registrationStarts) ? '' : strtoupper($scholarship->registrationStarts . ' to ') }}
                          </small>
                          <br>
                          <small>{{ strtoupper($scholarship->registrationEnds) }}</small>
                        </div>
                      @endif
                    </td>
                    <td>
                      <small class="badge {{ $scholarship->is_live ? 'badge-success-inverted' : 'badge-default-inverted' }}">{{ $scholarship->status }}</small>
                    </td>
                    
                      <td>
                        <div class="btn-group mr-1 mb-1">
                          <button aria-expanded="false" aria-haspopup="true" class="btn btn-grey dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton6" type="button">Actions</button>
                          <div aria-labelledby="dropdownMenuButton6" class="dropdown-menu">
                            <a class="dropdown-item text-primary" href="{{ route('admin.scholarship_attendees.checkin', $scholarship->uid) }}"> {{ __('Check-in Attendees') }}</a>

                            @can ('isAdminGroup')
                              <hr>

                              <a class="dropdown-item" href="{{ route('admin.scholarships.edit', $scholarship->uid) }}"> {{ __('Edit') }}</a>

                              <a class="dropdown-item" href="javascript:;" onclick="confirm('{{ __("Are you sure you want to proceed?") }}') ? document.getElementById('status-{{$scholarship->uid}}').submit() : ''"> {{ __('Change Status') }}</a>
                              <form id="status-{{$scholarship->uid}}" action="{{ route('admin.scholarships.status', $scholarship->uid) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                                <input type="text" value="{{ $scholarship->is_live }}" name="is_live">
                              </form>

                              <a class="dropdown-item text-danger" href="javascript:;" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? document.getElementById('delete-{{$scholarship->uid}}').submit() : ''"> {{ __('Delete') }}</a>
                              <form id="delete-{{$scholarship->uid}}" action="{{ route('admin.scholarships.destroy', $scholarship->uid) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                              </form>
                            @endcan
                          </div>
                        </div>
                      </td>
                    
                  </tr>
                @endforeach

                @if ($loop->remaining === 0)
                  <tr style="background-color:#ced2db; text-transform: uppercase;">
                    <td colspan="5" class="p-3 text-center uppercase">
                      <small>Showing {{ $scholarships->firstItem() }} to {{ $scholarships->lastItem() }} of 
                      {{ $scholarships->total() }} records</small>
                    </td>
                  </tr>
                @endif

              @empty
                <tr>
                  <td colspan="5" class="text-center">No records found!</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <div class="mt-4">
            {{ $scholarships->links() }}
          </div>

        </div>

        </div>
      </div>
     
    </div>
  </div>
</div>

@endsection
